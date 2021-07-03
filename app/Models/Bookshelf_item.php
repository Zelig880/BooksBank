<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookshelf_item extends Model
{
    use HasFactory;

    protected $fillable = ['condition', 'status', 'bookshelf_id', 'book_id'];

    /**
     * Get book that belong to the Bookshelf_item
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    
    /**
     * The Bookshelf that belong to the Bookshelf_item.
     */
    public function bookshelf()
    {
        return $this->belongsTo(Bookshelf::class);
    }
    
    /**
     * The ledges that belong to the Bookshelf_item.
     */
    public function ledge()
    {
        return $this->hasMany(Ledge::class);
    }


}
