<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{

    protected $fillable = ['name', 'description', 'user_id', 'secret'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(InquiriyComment::class);
    }
}
