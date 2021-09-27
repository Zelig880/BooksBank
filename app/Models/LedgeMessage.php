<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgeMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'lender_id',
        'user_id',
        'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ledge()
    {
        return $this->belongsTo(Ledge::class);
    }
}
