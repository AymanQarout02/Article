<?php

namespace App\Services\category;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService
{

    public function getAllCategories()
    {
        return Category::orderBy('created_at', 'desc')
            ->paginate(3);
    }

    public function getCategoryById($categoryId)
    {
        return Category::findOrFail($categoryId);
    }

    public function storeCategory($data): void
    {
       Category::create([
            'name' => $data['name'],
            'created_by' => auth()->id(),
        ]);
    }

    public function updateCategory(Category $category, $data): void
    {
        $category->update([
            'name' => $data['name'],
            'updated_by' => auth()->id(),
            'updated_at' => now(),
        ]);
    }

    public function deleteCategory($category) : bool
    {
        if($category->articles()->count() > 0) {
            return false;
        }else{
            $category->deleted_by = auth()->id();
            $category->save();
            $category->delete();
            return true;
        }
    }
    public function getArticlesByCategoryId(Category $category)
    {
        return $category->articles()->orderByDesc('created_at')->paginate(9);
    }

}
