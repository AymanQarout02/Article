<?php

namespace App\Http\Controllers\article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleCreateRequest;
use App\Http\Requests\Article\ArticleUpdateRequest;
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
        $categories = $this->articleService->getAllCategories();
        return view('article.index', compact(['articles','categories']));
    }

    public function show($articleId){
        $article = $this->articleService->getArticleById($articleId);
        return view('article.show', compact('article'));
    }

    public function create() {
        $categories = $this->articleService->getAllCategories();
        return view('article.create',compact('categories'));
    }

    public function store(ArticleCreateRequest $request){
       $this->articleService->storeArticle($request, $request->validated());
       return redirect()->route('user.show' ,auth()->id())->with('success', 'Article created successfully.');
    }

    public function edit(Article $article){
        $selectedCategory = $article->categories->pluck('id')->toArray();
        $categories = $this->articleService->getAllCategories();
        return view('article.edit', compact(['article', 'categories','selectedCategory']));
    }

    public function update(Article $article, ArticleUpdateRequest $request){

        $data = $request->validated();
        $this->articleService->updateArticle($request, $article,$data);
        return redirect()->route('user.show',auth()->id())->with('success', 'Article updated successfully.');

    }
    public function destroy(Article $article){
        $this->articleService->deleteArticle($article);
        return redirect()->route('user.show' , Auth()->id())->with('success', 'Article deleted successfully.');
    }


}
