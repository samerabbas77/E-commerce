<?php

namespace App\Models\Api\Refund;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefundItem extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'refund_items';

    protected $fillable = ['refund_id','product_id','quantity'];
}
