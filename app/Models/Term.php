<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function schoolSession()
    {
        return $this->belongsTo(SchoolSession::class,"session_id");
    }
    public function fees()
    {
        return $this->hasMany(FeeSetup::class,"term_id");
    }
}
