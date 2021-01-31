<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'thumbnail', 'ISBN'];

    /**
     * The categories that belong to the book.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    
    /**
     * The authors that belong to the book.
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
    
    /**
     * The bookshelves that belong to the book.
     */
    public function bookshelf_items()
    {
        return $this->belongsToMany(Bookshelf_item::class);
    }
    
}
