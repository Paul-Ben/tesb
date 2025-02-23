<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function schoolSession()
    {
        return $this->belongsTo(SchoolSession::class);
    }

    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }
}
