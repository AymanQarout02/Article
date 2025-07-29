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

    public function show($categoryId)
    {
        $articles = $this->categoryService->getArticlesByCategoryId($categoryId);
        return view('category.show', compact('articles'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $this->categoryService->storeCategory($request->all());
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function edit($categoryId)
    {
        $category = $this->categoryService->getCategoryById($categoryId);
        return view('category.edit', compact('category'));
    }

    public function update(Category $category, Request $request)
    {
        $this->categoryService->updateCategory($category, $request->all());
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($CategoryId)
    {
        $this->categoryService->deleteCategory($CategoryId);
        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }}
