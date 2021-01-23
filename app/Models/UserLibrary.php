<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLibrary extends Model
{
    use HasFactory;

    
    /**
     * Get user that belong to the Library
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get book that belong to the Library
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
