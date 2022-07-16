<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function order()
    {
        return $this->belongsToMany(Order::class,'order_product','order_id','product_id')->withPivot(['order_id','product_id']);
        // return $this->belongsToMany(Order::class,'order_product','order_id','product_id')
        // ->withPivot('jumlah_harga','jumlah','giling','pesan');
    } 
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function reviews() 
    { 
        return $this->hasMany(Review::class, 'product_id', 'id');
    } 
    public function wishlists() 
    { 
        return $this->belongsTo(Wishlist::class, 'product_id', 'id');
    } 
}
