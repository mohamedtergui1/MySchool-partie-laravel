<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
        'classroom_id',
        'title',
        'date',
        'classromm_id'
    ];
    function results(){
        return $this->hasMany(Result::class);
    }
    function classroom(){
        return $this->belongsTo(Classroom::class);
    }
}
