<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    protected $fillable = [
        "year"
        ,
        "TheCurrent"
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($promo) {
            // set all other promos' TheCurrent column to false
            static::query()->update(['TheCurrent' => false]);
        });
    }
}
