<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookshelf_item extends Model
{
    use HasFactory;

    protected $fillable = ['condition', 'status', 'user_id'];

    /**
     * Get user that belong to the Bookshelf_item
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get book that belong to the Bookshelf_item
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    
    /**
     * The Bookshelf that belong to the Bookshelf.
     */
    public function bookshelf()
    {
        return $this->belongsTo(Bookshelf::class);
    }
}
