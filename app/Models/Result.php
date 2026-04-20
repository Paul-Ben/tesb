<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    public $guarded = [];

    public function scoredSubjects()
    {
        return $this->subjects->filter(function ($subject) {
            return !((int) $subject->ca === 0 && (int) $subject->exam === 0);
        });
    }

    public function scoredAverage()
    {
        $scoredSubjects = $this->scoredSubjects();

        if ($scoredSubjects->isEmpty()) {
            return null;
        }

        return $scoredSubjects->avg('total');
    }

    public static function calculatePositions($classId, $term, $session)
    {
        $results = self::whereHas('student', function($query) use ($classId) {
            $query->where('class_id', $classId);
        })
        ->where('term', $term)
        ->where('session', $session)
        ->with('subjects')
        ->get()
        ->map(function($result) {
            $average = $result->scoredAverage();

            return [
                'id' => $result->id,
                'average' => $average ?? -1,
            ];
        })
        ->sortByDesc('average')
        ->values()
        ->map(function($result, $index) {
            return [
                'id' => $result['id'],
                'position' => $index + 1
            ];
        })
        ->pluck('position', 'id');

        return $results;
    }

    public function subjects()
    {
        return $this->hasMany(ResultSubject::class);
    }

    public function affectiveDevelopment()
    {
        return $this->hasMany(ResultAffectiveDevelopment::class, 'result_id');
    }
    public function sesison()
    {
        return $this->belongsTo(SchoolSession::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
