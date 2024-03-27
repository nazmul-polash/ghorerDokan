<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_name', 'parent_id'];

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id', 'id');
    }

    // Define recursive function to get category hierarchy
    public static function getCategoryHierarchy($parentId = null)
    {
        $categories = self::where('parent_id', $parentId)->get();

        $categoryHierarchy = [];

        foreach ($categories as $category) {
            $categoryHierarchy[] = [
                'category_name' => $category->category_name,
                'children' => self::getCategoryHierarchy($category->id)
            ];
        }

        return $categoryHierarchy;
    }
}
