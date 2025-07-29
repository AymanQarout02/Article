<?php

namespace App\Http\Controllers\article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Services\article\ArticleService;

class ArticleController extends Controller
{
    public ArticleService $articleService;
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(){
        $articles = $this->articleService->getAllArticles();

        return view('article.index', compact('articles'));
    }

    public function show($articleId){
        $article = $this->articleService->getArticleById($articleId);

        return view('article.show', compact('article'));
    }

    public function create() {
        $categories = $this->articleService->getAllCategories();
        return view('article.create',compact('categories'));
    }

    public function store(Request $request){
       $this->articleService->storeArticle($request->all());
       return redirect()->route('article.index')->with('success', 'Article created successfully.');
    }

    public function edit($articleId){
        $article = $this->articleService->getArticleById($articleId);
        return view('article.edit', compact('article'));
    }

    public function update(Article $article, Request $request){
        $this->articleService->updateArticle($article,$request->all());
        return redirect()->route('article.index')->with('success', 'Article updated successfully.');

    }

    public function destroy($ArticleId){
        $this->articleService->deleteArticle($ArticleId);
        return redirect()->route('article.index')->with('success', 'Article deleted successfully.');
    }


}
