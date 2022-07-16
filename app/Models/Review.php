<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    } 
    public function product() 
    {
     return $this->belongsTo(Product::class, 'product_id', 'id');
    } 
    public function user()
    {
        return $this->belongsTo (User::class,'user_id');
    }
}
