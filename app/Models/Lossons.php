<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lossons extends Model
{    
    use HasFactory;
    protected $fillable = [
        "name"
        ,
        "classroom_id"
        ,
        "course_file"
    ];

    function classroom(){
        return $this->belongsTo(Classroom::class);
    }
   
}
