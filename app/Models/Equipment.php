<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'classroom_id',
        'name',
        'quantity'
    ];
    function classroom(){
        return $this->belongsTo(Classroom::class);
    }
}
