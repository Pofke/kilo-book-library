<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'book_id',
        'user_id',
        'status',
        'extended_date',
        'returned_date'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
