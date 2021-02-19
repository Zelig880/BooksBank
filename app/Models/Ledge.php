<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledge extends Model
{
    use HasFactory;

    protected $fillable = ['lender_id', 'borrower_id', 'book_id', 'bookshelf_item_id'];

    /**
     * Get lender of a transaction
     */
    public function lender()
    {
        return $this->belongsTo(Bookshelf::class, 'lender_id');
    }

    /**
     * Get borrower of a transaction
     */
    public function borrower()
    {
        return $this->belongsTo(Bookshelf::class, 'borrower_id');
    }

    /**
     * Get book of a transaction
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
