<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function classCategory()
    {
        return $this->belongsTo(ClassCategory::class, 'category_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
}
