<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'prof_id',
        'level_id',
        "quantity",
        "period"
    ];
    function students(){
        $this->belongsToMany(User::class,"user_classroom");
    }
    function equipments(){
        return $this->hasMany(Equipment::class);
    }
    function exams(){
        return $this->hasMany(Exam::class);
    }
}
