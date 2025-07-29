<?php

namespace App\Services\category;
use App\Models\Category;

class CategoryService
{

    public function getAllCategories()
    {
        return Category::all()->orderByDesc('created_at')->paginate(9);
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
            'description' => $data['description'],
        ]);
    }

    public function deleteCategory($categoryId) : bool
    {
        $category = $this->getCategoryById($categoryId);

        if($category->articles()->count() > 0) {
            return false;
        }else{
            $category->delete();
            return true;
        }
    }

}
