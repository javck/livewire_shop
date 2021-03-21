<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    //此商品屬於哪些訂單
    public function orders()
    {
        return $this->belongsToMany(\App\Models\Order::class)->withTimestamps();
    }

}
