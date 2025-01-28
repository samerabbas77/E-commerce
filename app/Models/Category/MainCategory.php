<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'main_categories';

    /**
     * The attributes that are mass assignable
     * @var array
     */
    protected $fillable = ['main_category_name'];

    //....................Relation.................
    public function subcategories()
    {
        return $this->belongsToMany(SubCategory::class,'main_category_subcategories',
        'main_category_id','sub_category_id')
                    ->wherePivotNull('deleted_at')
                    ->withTimestamps();
    }
}
