<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InquiriyComment extends Model
{
    public function inquiriyser()
    {
        return $this->belongsTo(Inquiriy::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
