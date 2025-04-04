<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeSetup extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id');
    }
    public function classCategory()
    {
        return $this->belongsTo(ClassCategory::class, 'class_id');
    }
}
