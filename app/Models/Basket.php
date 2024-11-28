<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    protected $table = 'basket'; // Specify the correct table name

    protected $guarded = [];

    // The user who owns the basket item
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // The book that's in the basket
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
