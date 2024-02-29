<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'exam_id',
        "note" ,
        "date"
    ];
    function exam(){
        return $this->belongsTo(Exam::class);
    }
    function user(){
        return $this->belongsTo(User::class);
    }
}
