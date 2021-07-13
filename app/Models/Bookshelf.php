<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Malhal\Geographical\Geographical;

class Bookshelf extends Model
{
    use HasFactory, Geographical;

    protected $fillable = [
        'longitude',
        'latitude',
        'opening_days',
        'opening_hours',
        'address_line_1',
        'city',
        'postcode',
    ];

    protected $casts = [
        'opening_days' => 'array',
        'opening_hours' => 'array'
    ];

    protected $hidden = [
        'address_line_1'
    ];

    /**
     * Get user that belong to the Bookshelf
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The bookshel items that belong to the bookshelf.
     */
    public function bookshelf_items()
    {
        return $this->hasMany(Bookshelf_item::class);
    }
}
