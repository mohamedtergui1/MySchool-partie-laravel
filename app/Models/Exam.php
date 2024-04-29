<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "date",
        "classroom_id",
        "corrected"
    ];
    function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    function results()
    {
        return $this->hasMany(Result::class);
    }

    function students(){
        return $this->belongsToMany(User::class, "results","exam_id", "student_id");
    }
}
