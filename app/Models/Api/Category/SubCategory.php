<?php

namespace App\Models\Api\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'sub_categories';

    /**
     * The attributes that are mass assignable
     * @var array
     */
    protected $fillable = ['sub_category_name'];

      //....................Relation.................
      public function categories()
      {
          return $this->belongsToMany(MainCategory::class,'main_category_subcategories',
                      'sub_category_id','main_category_id')
                      ->wherePivotNull('deleted_at')
                      ->withTimestamps();
      }
}
