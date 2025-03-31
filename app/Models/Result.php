<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $guarded = [];

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
}
