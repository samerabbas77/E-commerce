<?php

namespace App\Models\Api\Cart;

use App\Models\Api\Product\Product;
use App\Models\Api\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['user_id'];

    //................Relation..................
    //one to one Relation
    public function user()
    {
        $this->belongsTo(User::class);
    }

    //Many to Many relation(cart_items)
    public function products()
    {
        return $this->belongsToMany(Product::class,'cart_items','cart_id','product_id')
                    ->withPivot('quantity')
                    ->wherePivotNull('deleted_at')
                    ->withTimestamps();     
    }
}
