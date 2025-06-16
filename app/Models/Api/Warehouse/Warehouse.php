<?php

namespace App\Models\Api\Warehouse;

use App\Models\Api\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    use HasFactory;

    protected $table = 'warehouses';

    protected $fillable = ['name', 'address', 'city'];

    //.............Relation................

    /**
     *  mony To Many Relation (warehouse have many products)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class,'warehouse_products','warehouse_id','product_id','id','id')
                     ->withPivot('stack', 'last_updated')
                     ->withTimestamps();
    }
        
}
