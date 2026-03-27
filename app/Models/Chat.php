<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'user_id',
        'vendor_id'
    ];

    // User (who started chat)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Vendor
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    // Messages
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}