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
        return $this->hasMany(ResultAffectiveDevelopment::class);
    }
}
