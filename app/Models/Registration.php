<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function term()
    {
        return $this->belongsTo(Term::class);
    }
    public function session()
    {
        return $this->belongsTo(SchoolSession::class);
    }
}
