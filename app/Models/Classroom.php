<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'teatcher_id',
        'grade_id',
        "quantity",
        "promo"
    ];
    function students(){
        $this->belongsToMany(User::class,"scholasticyears");
    }
    function teatcher(){
        return $this->belongsTo(User::class,"teatcher_id");
    }
    function promo(){
        return $this->belongsTo(Promo::class );
    }
    function grade(){
        return $this->belongsTo(Grade::class );
    }
}
