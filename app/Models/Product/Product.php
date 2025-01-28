<?php

namespace App\Models\Product;

use App\Models\Cart\Cart;
use App\Models\Order\Order;
use App\Models\Photo\Photo;
use App\Models\Bundle\Bundle;
use App\Models\Refund\Refund;
use App\Models\Review\Review;
use App\Models\Favorite\Favorite;
use App\Models\Category\SubCategory;
use App\Models\Category\MainCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category\MainCategorySubcategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name','price','description','stack','eco_score','maincategory_subcategory_id'];

    //....................Relation....................

    /**
     * many to many relation (product have many carts)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function carts()
    {
        return $this->belongsToMany(Cart::class,'cart_items','product_id','cart_id')
                    ->withPivot('quantity')
                    ->wherePivotNull('deleted_at')
                    ->withTimestamps();
    }

    //...........................
    //...........................
    /**
     * many to many relation (product have many bundles)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function bundles()
    {
        return $this->belongsToMany(Bundle::class,'bundle_product','product_id','bundle_id')
                    ->withPivot('quantity')
                    ->wherePivotNull('deleted_at')
                    ->withTimestamps();
    }

    //...........................
    //...........................
    /**
     * many to many relation (product have many refunds)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function refunds()
    {
        return $this->belongsToMany(Refund::class,'refund_items','product_id','refund_id')
                    ->withPivot('quantity')
                    ->wherePivotNull('deleted_at')  
                    ->withTimestamps();
    }

    //..........................
    //..........................
    /**
 * many to many relation (products have many orders )
 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
 */
public function orders()
{
    return $this->belongsToMany(Order::class,'order_product','product_id','order_id')
                ->withPivot('quantity')
                ->wherePivotNull('deleted_at')
                ->withTimestamps();
}

//..........................
//..........................
 public function category()
 {
    return $this->belongsTo(MainCategorySubcategory::class,'maincategory_subcategory_id');
 }
 //...................

/**
 * Get the main category associated with the product.
 *
* @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
*/
public function mainCategory()
{
    return $this->hasOneThrough(
        MainCategory::class,
        MainCategorySubCategory::class,
        'id',
        'id',
        'maincategory_subcategory_id',
        'main_category_id'
    );
}
 //...................
/**
 * Get the subcategory associated with the product.
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
 */
public function subCategory()
{
    return $this->hasOneThrough(
        SubCategory::class,
        MainCategorySubCategory::class,
        'id',
        'id',
        'maincategory_subcategory_id',
        'sub_category_id'
    );
}
//..........................morph..............
//...............................................
   /**
     * morph many to photo (product have many photos), every product have multiple photos about it
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function photos()
    {
        return $this->morphMany(Photo::class,'photoable');
    }

    //...................
    //...................

    /**
     * morph many to favorite (product have many favorites),for exampe:
     * user 1 add product 1 to its favorite also user2 and 3 so now we have 
     * 3 records in favorite table connecting to same product
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class,'favorable');
    }

    //................
    //................

    /**
     * multi user could review the product ,so it will be multiple records on
     * review table belongs to same product.
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reviews()
    {
        return $this->morphMany(Review::class,'photoable');
    }


}
