<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'description', 'secondary_category_id', 'price', 'image_file_name'];

    public function secondaryCategory()
    {
        return $this->belongsTo(SecondaryCategory::class);
    }
}
