<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'author',
        'year',
        'genre',
        'pages',
        'language',
        'quantity'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
