<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details');
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo_item::class);
    }

    public function photo()
    {
        return $this->hasOne(Photo_item::class);
    }

    public function shortItems()
    {
        return $this->with('photo')->limit(20)->orderBy('sold')->get();
    }
}
