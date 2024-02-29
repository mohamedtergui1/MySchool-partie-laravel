<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absense extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'datetime_start',
        'datetime_end',
        'status'
    ];
    function user(){
        return $this->belongsTo(User::class);
    }
}
