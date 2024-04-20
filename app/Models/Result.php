<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable = [
        "note",
        "exam_id",
        "student_id"
    ];

    public function student()
    {
        return $this->belongsTo(User::class, "student_id");
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, "exam_id");
    }
}
