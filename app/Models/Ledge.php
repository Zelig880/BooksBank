<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledge extends Model
{
    use HasFactory;

    protected $fillable = [
        'lender_id',
        'borrower_id',
        'book_id',
        'bookshelf_item_id',
        'pickup_date',
        'return_date',
        'status'
    ];

    protected $casts = [
        'pickup_date' => 'datetime',
        'return_date' => 'datetime',
    ];

    /**
     * Get lender of a transaction
     */
    public function lender()
    {
        return $this->belongsTo(User::class, 'lender_id')->select(['id', 'name', 'email']);
    }

    /**
     * Get borrower of a transaction
     */
    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrower_id')->select(['id', 'name', 'email']);
    }

    /**
     * Get book of a transaction
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    
    /**
     * The Bookshelf_item that belong to the ledge.
     */
    public function bookshelf_item()
    {
        return $this->belongsTo(Bookshelf_item::class);
    }
}
