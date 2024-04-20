<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'teacher_id',
        'grade_id',
        "promo_id"
    ];
    function students()
    {
        return $this->belongsToMany(User::class, "scholasticyears", "classroom_id", "student_id");
    }

    function teacher()
    {
        return $this->belongsTo(User::class, "teacher_id");
    }
    function promo()
    {
        return $this->belongsTo(Promo::class);
    }
    function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
