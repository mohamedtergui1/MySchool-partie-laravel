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
        "classroom_id"
    ];
    function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
