<?php

namespace App\Models\Bundle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BundleProduct extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'bundle_product';

    /**
     * The attributes that are mass assignable
     * @var array
     */
    protected $fillable = ['product_id', 'bundle_id', 'quantity'];

}
