<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curse extends Model
{
    use HasFactory;
    protected $fillable = [
        'prof_id',
        'name',
        'description',
        'classroom_id'
    ];
}
