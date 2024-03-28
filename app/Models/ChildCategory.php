<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;

    protected $table = 'child_categories';

    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'parent_id','id');
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }

}
