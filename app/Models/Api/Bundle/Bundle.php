<?php

namespace App\Models\Api\Bundle;

use App\Models\Api\Photo\Photo;
use App\Models\Api\Product\Product;
use App\Models\Api\Favorite\Favorite;
use App\Models\Api\Review\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bundle extends Model
{
    use HasFactory,SoftDeletes;

      /**
     * The attributes that are mass assignable
     * @var array
     */
    protected $fillable = ['title','description','price','discount_amount',
                           'total_price','status','start_date','end_date','usage_limit'];

    //...................Relation....................
    
    //Many to Many Relation
    public function products()
    {
        $this->belongsToMany(Product::class,'bundle_product')
            ->withPivot('quantity')
            ->wherePivotNull('deleted_at')
            ->withTimestamps();
    }
    //....................
    //....................

    /**
     * morph many to photo (bundle have many photos), every bundle have multiple photos about it
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function photos()
    {
        return $this->morphMany(Photo::class,'photoable');
    }

    //...................
    //...................

    /**
     * morph many to favorite (bundle have many favorites),for exampe:
     * user 1 add bundle 1 to its favorite also user2 and 3 so now we have 
     * 3 records in favorite table connecting to same bundle
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class,'favorable');
    }

    //................
    //................

    /**
     * multi user could review the bundle ,so it will be multiple records on
     * review table belongs to same bundle.
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reviews()
    {
        return $this->morphMany(Review::class,'photoable');
    }
}
