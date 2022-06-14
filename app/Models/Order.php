<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_client',
        'id_table',
        'id_user',
        'total_price',
        'status'
    ];

    protected $attributes = [
        'total_price' =>  0,
        'status' =>  'open'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function table()
    {
        return $this->belongsTo(Table::class, 'id_table');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'order_items');
    }
}
