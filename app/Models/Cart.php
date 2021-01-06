<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('quantity');
    }

    public function getCarts($id)
    {
        return $this->with(['items' => function ($item) {
            $item->with('photo');
        }])->find($id);
    }
}
