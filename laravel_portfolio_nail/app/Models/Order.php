<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{

    protected $fillable = ['item_id', 'payment_id', 'order_number', 'quantity', 'name', 'image_file_name', 'price'];
    //

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
