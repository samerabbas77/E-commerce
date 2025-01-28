<?php

namespace App\Models\Category;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainCategorySubcategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'maincategory_subcategory';

    /**
     * The attributes that are mass assignable
     * @var array
     */
    protected $fillable = ['main_category_id','sub_category_id'];

     //....................Relation.................

     public function products()
     {
        return $this->hasMany(Product::class,'maincategory_subcategory_id','id');
     }
}
