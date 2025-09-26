<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    public $guarded = [];

    public static function calculatePositions($classId, $term, $session)
    {
        $results = self::whereHas('student', function($query) use ($classId) {
            $query->where('class_id', $classId);
        })
        ->where('term', $term)
        ->where('session', $session)
        ->get()
        ->map(function($result) {
            return [
                'id' => $result->id,
                'average' => $result->subjects->avg('total'),
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
