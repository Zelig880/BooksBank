<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Malhal\Geographical\Geographical;

class Bookshelf extends Model
{
    use HasFactory;
    use Geographical;

    protected $fillable = ['longitude', 'latitude'];
    
    /**
     * Get user that belong to the Bookshelf
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The bookshelves that belong to the setting.
     */
    public function bookshelf_items()
    {
        return $this->belongsToMany(Bookshelf_item::class);
    }
}
