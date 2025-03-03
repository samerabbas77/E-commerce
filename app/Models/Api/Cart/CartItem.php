<?php

namespace App\Models\Api\Cart;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'cart_items';

    /**
     * The attributes that are mass assignable
     * @var array
     */
    protected $fillable= ['cart_id','product_id','quantity'];

  
}
