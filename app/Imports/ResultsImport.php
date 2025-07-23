<?php

namespace App\Imports;

use App\Models\Result;
use App\Models\ResultSubject;
use App\Models\ResultAffectiveDevelopment;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ResultsImport implements ToCollection, WithHeadingRow
{
    protected $classroom;
    protected $subject;
    protected $term;
    protected $session;
    protected $processed = 0;
    protected $errors = [];

    /**
     * Create a new import instance.
     *
     * @param  \App\Models\Classroom  $classroom
     * @param  \App\Models\Subject  $subject
     * @param  \App\Models\Term  $term
     * @param  \App\Models\SchoolSession  $session
     * @return void
     */
    public function __construct($classroom, $subject, $term, $session)
    {
        $this->classroom = $classroom;
        $this->subject = $subject;
        $this->term = $term;
        $this->session = $session;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $index => $row) {
            // Manual validation for required fields
            if (empty($row['student_number'])) {
                $this->errors[] = "Row " . ($index + 2) . ": Student number is required.";
                continue;
            }
            
            if (!isset($row['ca']) || !is_numeric($row['ca'])) {
                $this->errors[] = "Row " . ($index + 2) . ": CA score is required and must be numeric.";
                continue;
            }
            
            if (!isset($row['exam']) || !is_numeric($row['exam'])) {
                $this->errors[] = "Row " . ($index + 2) . ": Exam score is required and must be numeric.";
                continue;
            }
            
            // Find the student
            $student = Student::where('std_number', $row['student_number'])
                ->where('class_id', $this->classroom->id)
                ->first();
            
            if (!$student) {
                $this->errors[] = "Row " . ($index + 2) . ": Student with number {$row['student_number']} not found in this class.";
                continue;
            }
            
            // Check if result already exists
            $existingResult = Result::where('student_id', $student->id)
                ->where('term', $this->term->name)
                ->where('session', $this->session->sessionName)
                ->first();
            
            // Get additional fields from CSV
            $schoolOpened = isset($row['school_opened']) ? (int) $row['school_opened'] : 0;
            $timesPresent = isset($row['times_present']) ? (int) $row['times_present'] : 0;
            $timesAbsent = isset($row['times_absent']) ? (int) $row['times_absent'] : 0;
            $teacherRemark = isset($row['teacher_remark']) ? $row['teacher_remark'] : '';
            
            // Handle date with multiple format support
            $resultDate = now(); // Default to current date
            if (isset($row['date']) && !empty($row['date'])) {
                try {
                    // Try to parse various date formats
                    $dateValue = $row['date'];
                    
                    // Check if it's an Excel serial date number
                    if (is_numeric($dateValue) && $dateValue > 1) {
                        // Excel serial date: days since 1900-01-01 (with leap year bug)
                        $excelEpoch = new \DateTime('1900-01-01');
                        // Excel incorrectly treats 1900 as a leap year, so subtract 2 days
                        $days = (int)$dateValue - 2;
                        $parsedDate = $excelEpoch->add(new \DateInterval('P' . $days . 'D'));
                        $resultDate = $parsedDate->format('Y-m-d');
                    } else {
                        // Common date formats to try
                        $formats = [
                            'Y-m-d',        // 2024-01-15
                            'd/m/Y',        // 15/01/2024
                            'm/d/Y',        // 01/15/2024
                            'd-m-Y',        // 15-01-2024
                            'm-d-Y',        // 01-15-2024
                            'Y/m/d',        // 2024/01/15
                            'd.m.Y',        // 15.01.2024
                            'j/n/Y',        // 15/1/2024 (no leading zeros)
                            'n/j/Y',        // 1/15/2024 (no leading zeros)
                        ];
                        
                        $parsedDate = null;
                        foreach ($formats as $format) {
                            $parsed = \DateTime::createFromFormat($format, $dateValue);
                            if ($parsed && $parsed->format($format) === $dateValue) {
                                $parsedDate = $parsed;
                                break;
                            }
                        }
                        
                        if ($parsedDate) {
                            $resultDate = $parsedDate->format('Y-m-d');
                        } else {
                            // Try strtotime as fallback
                            $timestamp = strtotime($dateValue);
                            if ($timestamp !== false) {
                                $resultDate = date('Y-m-d', $timestamp);
                            } else {
                                $this->errors[] = "Row " . ($index + 2) . ": Invalid date format '{$dateValue}'. Please use formats like YYYY-MM-DD, DD/MM/YYYY, or MM/DD/YYYY.";
                                continue;
                            }
                        }
                    }
                } catch (\Exception $e) {
                    $this->errors[] = "Row " . ($index + 2) . ": Error parsing date '{$row['date']}': {$e->getMessage()}";
                    continue;
                }
            }
            
            // Create or update the result
            try {
                if (!$existingResult) {
                    // Create a new result
                    $result = Result::create([
                        'student_id' => $student->id,
                        'student_number' => $student->std_number,
                        'student_name' => $student->first_name . ' ' . $student->last_name,
                        'class' => $this->classroom->name,
                        'term' => $this->term->name,
                        'session' => $this->session->sessionName,
                        'school_opened' => $schoolOpened,
                        'times_present' => $timesPresent,
                        'times_absent' => $timesAbsent,
                        'teacher_remark' => $teacherRemark,
                        'date' => $resultDate,
                    ]);
                } else {
                    // Update existing result with new data
                    $existingResult->update([
                        'school_opened' => $schoolOpened,
                        'times_present' => $timesPresent,
                        'times_absent' => $timesAbsent,
                        'teacher_remark' => $teacherRemark,
                        'date' => $resultDate,
                    ]);
                    $result = $existingResult;
                }
                
                // Validate CA and Exam scores
                $ca = (int) $row['ca'];
                $exam = (int) $row['exam'];
                $total = $ca + $exam;
                
                // Get class category for validation
                $classCategory = $this->classroom->classCategory->name;
                
                // Validate based on class category
                $caMax = 40; // Default
                $examMax = 60; // Default
                
                switch ($classCategory) {
                    case 'Kindergarten':
                        $caMax = 50;
                        $examMax = 50;
                        break;
                    case 'Primary':
                        $caMax = 40;
                        $examMax = 60;
                        break;
                    case 'Junior Secondary School':
                        $caMax = 60;
                        $examMax = 40;
                        break;
                    case 'Senior Secondary School':
                        $caMax = 30;
                        $examMax = 70;
                        break;
                }
                
                if ($ca < 0 || $ca > $caMax) {
                    $this->errors[] = "Invalid CA score for student {$row['student_number']}: {$ca}. Must be between 0 and {$caMax}.";
                    continue;
                }
                
                if ($exam < 0 || $exam > $examMax) {
                    $this->errors[] = "Invalid Exam score for student {$row['student_number']}: {$exam}. Must be between 0 and {$examMax}.";
                    continue;
                }
                
                // Calculate grade
                $grade = $this->calculateGrade($total);
                
                // Get optional class statistics from CSV (if provided)
                $highestInClass = isset($row['highest_in_class']) && $row['highest_in_class'] > 0 ? (int) $row['highest_in_class'] : 0;
                $lowestInClass = isset($row['lowest_in_class']) && $row['lowest_in_class'] > 0 ? (int) $row['lowest_in_class'] : 0;
                $position = isset($row['position']) && $row['position'] > 0 ? (int) $row['position'] : 0;
                
                // Check if subject result already exists
                $existingSubject = ResultSubject::where('result_id', $result->id)
                    ->where('subject', $this->subject->name)
                    ->first();
                
                if ($existingSubject) {
                    // Update existing subject result
                    $existingSubject->update([
                        'ca' => $ca,
                        'exam' => $exam,
                        'total' => $total,
                        'grade' => $grade,
                        'highest_in_class' => $highestInClass,
                        'lowest_in_class' => $lowestInClass,
                        'position' => $position,
                    ]);
                } else {
                    // Create new subject result
                    ResultSubject::create([
                        'result_id' => $result->id,
                        'subject' => $this->subject->name,
                        'ca' => $ca,
                        'exam' => $exam,
                        'total' => $total,
                        'grade' => $grade,
                        'highest_in_class' => $highestInClass,
                        'lowest_in_class' => $lowestInClass,
                        'position' => $position,
                    ]);
                }
                
                // Handle affective development data
                $affectiveFields = [
                    'punctuality' => isset($row['punctuality']) ? $row['punctuality'] : '',
                    'neatness' => isset($row['neatness']) ? $row['neatness'] : '',
                    'attentiveness' => isset($row['attentiveness']) ? $row['attentiveness'] : '',
                    'participation' => isset($row['participation']) ? $row['participation'] : '',
                    'obedience' => isset($row['obedience']) ? $row['obedience'] : '',
                    'honesty' => isset($row['honesty']) ? $row['honesty'] : '',
                    'relationship' => isset($row['relationship']) ? $row['relationship'] : '',
                ];
                
                // Create or update affective development records
                foreach ($affectiveFields as $category => $rating) {
                    if (!empty($rating)) {
                        $existingAffective = ResultAffectiveDevelopment::where('result_id', $result->id)
                            ->where('category', $category)
                            ->first();
                        
                        if ($existingAffective) {
                            $existingAffective->update(['rating' => $rating]);
                        } else {
                            ResultAffectiveDevelopment::create([
                                'result_id' => $result->id,
                                'category' => $category,
                                'rating' => $rating,
                            ]);
                        }
                    }
                }
                
                $this->processed++;
                
            } catch (\Exception $e) {
                $this->errors[] = "Error processing student {$row['student_number']}: {$e->getMessage()}";
            }
        }
        
        // Calculate class statistics after all records are processed
        $this->calculateClassStatistics();
    }



    /**
     * Get the number of processed records
     *
     * @return int
     */
    public function getProcessedCount(): int
    {
        return $this->processed;
    }

    /**
     * Get any errors that occurred during import
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Calculate grade based on total score
     */
    private function calculateGrade($total)
    {
        if ($total >= 90) return 'A';
        if ($total >= 70) return 'B';
        if ($total >= 60) return 'C';
        if ($total >= 50) return 'D';
        return 'F';
    }

    /**
     * Calculate class statistics (highest, lowest, position) for the subject
     * Only updates records where these values are 0 (not manually provided)
     */
    private function calculateClassStatistics()
    {
        // Get all result subjects for this subject in the current term and session
        $subjectResults = ResultSubject::whereHas('result', function($query) {
            $query->where('term', $this->term->name)
                  ->where('session', $this->session->sessionName)
                  ->where('class', $this->classroom->name);
        })->where('subject', $this->subject->name)
          ->orderBy('total', 'desc')
          ->get();

        if ($subjectResults->isEmpty()) {
            return;
        }

        $highest = $subjectResults->first()->total;
        $lowest = $subjectResults->last()->total;
        $position = 1;
        $previousTotal = null;
        $actualPosition = 1;

        foreach ($subjectResults as $index => $subjectResult) {
            // Handle tied positions
            if ($previousTotal !== null && $subjectResult->total < $previousTotal) {
                $position = $actualPosition;
            }

            // Only update if values are 0 (not manually provided)
            $updateData = [];
            if ($subjectResult->highest_in_class == 0) {
                $updateData['highest_in_class'] = $highest;
            }
            if ($subjectResult->lowest_in_class == 0) {
                $updateData['lowest_in_class'] = $lowest;
            }
            if ($subjectResult->position == 0) {
                $updateData['position'] = $position;
            }

            if (!empty($updateData)) {
                $subjectResult->update($updateData);
            }

            $previousTotal = $subjectResult->total;
            $actualPosition++;
        }
    }
}