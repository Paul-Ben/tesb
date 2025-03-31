<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\ResultAffectiveDevelopment;
use App\Models\ResultSubject;
use App\Models\SchoolSession;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'student_number' => 'required|string|max:255',
            'student_name' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'class' => 'required|string|max:255',
            'term' => 'required|string|max:255',
            'session' => 'required|string|max:255',
            'school_opened' => 'nullable|integer',
            'times_present' => 'nullable|integer',
            'times_absent' => 'nullable|integer',
            'teacher_remark' => 'nullable|string',
            'principal_signature' => 'nullable|string|max:255',
            'date' => 'nullable|date',

            // Subjects validation
            'subject' => 'required|array',
            'subject.*' => 'required|string|max:255',
            'ca.*' => 'required|integer|min:0|max:40',
            'exam.*' => 'required|integer|min:0|max:60',
            'remark.*' => 'nullable|string|max:255',

            // Affective Development validation
            'punctuality' => 'nullable|string|max:255',
            'neatness' => 'nullable|string|max:255',
            'attentiveness' => 'nullable|string|max:255',
            'participation' => 'nullable|string|max:255',
            'obedience' => 'nullable|string|max:255',
            'honesty' => 'nullable|string|max:255',
            'relationship' => 'nullable|string|max:255',
        ]);

        // **Check if the result already exists for the student, term, and session**
        $existingResult = Result::where('student_id', $request->student_id)
            ->where('term', $request->term)
            ->where('session', $request->session)
            ->first();

        if ($existingResult) {
            $notification = [
                'message' => 'The result for this student already exists for the selected term and session.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }


        // Save Result
        $result = Result::create([
            'student_id' => $request->student_id,
            'student_number' => $request->student_number,
            'student_name' => $request->student_name,
            'state' => $request->state,
            'class' => $request->class,
            'term' => $request->term,
            'session' => $request->session,
            'school_opened' => $request->school_opened,
            'times_present' => $request->times_present,
            'times_absent' => $request->times_absent,
            'teacher_remark' => $request->teacher_remark,
            'principal_signature' => $request->principal_signature,
            'date' => $request->date,
        ]);

        // Save Subjects
        foreach ($request->subject as $key => $subjectName) {
            $ca = $request->ca[$key];
            $exam = $request->exam[$key];
            $total = $ca + $exam;

            // Calculate Grade
            $grade = $this->calculateGrade($total);

            ResultSubject::create([
                'result_id' => $result->id,
                'subject' => $subjectName,
                'ca' => $ca,
                'exam' => $exam,
                'total' => $total,
                'lowest_in_class' => $request->lowest_in_class[$key],
                'highest_in_class' => $request->highest_in_class[$key],
                'position' => $request->position[$key],
                'grade' => $grade,
                'remark' => $request->remark[$key] ?? '',
            ]);
        }

        // Save Affective Development
        $affectiveData = [
            'Punctuality' => $request->punctuality,
            'Neatness' => $request->neatness,
            'Attentiveness' => $request->attentiveness,
            'Participation in Class Activities' => $request->participation,
            'Obedience' => $request->obedience,
            'Honesty' => $request->honesty,
            'Relationship with Others' => $request->relationship,
        ];

        foreach ($affectiveData as $category => $rating) {
            if ($rating) {
                ResultAffectiveDevelopment::create([
                    'result_id' => $result->id,
                    'category' => $category,
                    'rating' => $rating,
                ]);
            }
        }
        $notification = [
            'message' => 'Result saved successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    private function calculateGrade($total)
    {
        if ($total >= 90) return 'A';
        if ($total >= 70) return 'B';
        if ($total >= 60) return 'C';
        if ($total >= 50) return 'D';
        return 'F';
    }

    // public function viewResult(Student $student)
    // {
    //    $age = Carbon::parse($student->date_of_birth)->age;        // Retrieve the active session
    //     $activeSession = SchoolSession::where('status', 'active')->first();

    //     // Retrieve the student's result details
    //     $results = Result::with('subjects','affectiveDevelopment')->where('student_id', $student->id)->first();
    //     // dd($result);
    //     if (!$results) {
    //         $notification = [
    //             'message' => 'No result found for this student.',
    //             'alert-type' => 'error',
    //         ];
    //         return redirect()->back()->with($notification);
    //     }
    //     // dd($result);
    //     // Retrieve subjects and scores related to the result
    //     // $subjects = ResultSubject::where('result_id', $results->id)->get();
    //     // dd($subjects);
    //     // Retrieve affective development records
    //     $affectiveDevelopment = ResultAffectiveDevelopment::where('result_id', $results->id)->get();
    //     $table1 = $affectiveDevelopment->take(4);
    //     $table2 = $affectiveDevelopment->slice(4);
    //     // Pass the retrieved data to a view
    //     $notification = [
    //         'message' => 'Result generated for this student.',
    //         'alert-type' => 'success',
    //     ];
    //     return view('teacher.result.show', compact('student', 'results', 'table1', 'table2', 'age'));
    // }
    public function getResults(Student $student, Result $result)
    {
        $authUser = auth()->user();
        $results = Result::where('student_id', $student->id)->get();
        if (!$results) {
            return redirect()->back()->with([
                'message' => 'No result found for this student.',
                'alert-type' => 'error',
            ]);
        }
        return view('teacher.result.studentResult', compact('student', 'results', 'authUser'));
    }

    public function singleResultView(Student $student, Result $result)
    {
        $student = Student::where('id', $result->student_id)->first();
        $age = Carbon::parse($student->date_of_birth)->age;
        $affectiveDevelopment = ResultAffectiveDevelopment::where('result_id', $result->id)->get();
        $table1 = $affectiveDevelopment->take(4);
        $table2 = $affectiveDevelopment->slice(4);
        return view('teacher.result.show', compact('student', 'result', 'table1', 'table2', 'age'));
    }
}
