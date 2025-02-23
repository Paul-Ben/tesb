<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function classCategory()
    {
        return $this->belongsTo(ClassCategory::class);
    }

    public function schoolSession()
    {
        return $this->belongsTo(SchoolSession::class);
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    
}
