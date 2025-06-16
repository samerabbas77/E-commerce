<?php

namespace App\Models\Api\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse_product extends Model
{
    use HasFactory;

    protected $table = 'warehouse_products';

    protected $fillable = [
        'warehouse_id',
        'product_id',
        'stack',
        'last_updated'
    ];
}
