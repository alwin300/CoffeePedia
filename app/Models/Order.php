<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory; 

    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    } 
    public function products()
    {
        // return $this->belongsToMany(Product::class);
        return $this->belongsToMany(Product::class,'order_product','order_id','product_id')->withPivot(['order_id','product_id']);
        // return $this->belongsToMany(Product::class,'order_product','order_id','product_id')
        // ->withPivot('jumlah_harga','jumlah','giling','pesan');
    } 

    public function payment()
    {
        return $this->belongsTo(Payment::class,'id','order_id');
    } 
}
