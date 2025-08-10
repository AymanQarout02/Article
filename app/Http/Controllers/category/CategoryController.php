<?php

namespace App\Http\Controllers\category;
use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\Category\CategoryService;

class CategoryController extends Controller
{
    public CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('category.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $articles = $this->categoryService->getArticlesByCategoryId($category);
        return view('category.show', compact('articles', 'category'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $this->categoryService->storeCategory($request->all());
        return redirect()->route('user.categories',auth()->id())->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Category $category, Request $request)
    {
        $this->categoryService->updateCategory($category, $request->all());
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $flag = $this->categoryService->deleteCategory($category);

        if ($flag)
            return redirect()->route('user.categories' , auth()->id())->with('success', 'Category deleted successfully.');
        else
            return redirect()->route('user.categories',auth()->id())->with('error', 'Category cannot be deleted as it has associated articles.');
    }
}
