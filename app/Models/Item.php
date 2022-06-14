<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description',
        'unit_price',
    ];
    
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menus_items');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items');
    }
}
