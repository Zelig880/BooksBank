<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookshelf extends Model
{
    use HasFactory;

    
    /**
     * Get user that belong to the Bookshelf
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get book that belong to the Bookshelf
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    
    /**
     * The books that belong to the Bookshelf.
     */
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
