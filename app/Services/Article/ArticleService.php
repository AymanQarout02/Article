<?php

namespace App\Services\Article;
use App\Http\Requests\Article\ArticleCreateRequest;
use App\Http\Requests\Article\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArticleService
{

    public function getAllArticles()
    {
        return Article::orderBy('created_at', 'desc')
            ->paginate(6);
    }

    public function getAllCategories()
    {
        return Category::orderBy('created_at', 'desc')
            ->paginate(6);
    }

    public function getArticleById($articleId)
    {
        return Article::findOrFail($articleId);
    }

    public function storeArticle(ArticleCreateRequest $request, $data): void
    {

        $data['created_by'] = Auth::id();

        $article = Article::create($data);


        if (isset($data['categories'])) {
            $article->categories()->sync($data['categories']);
        } else {
            $article->categories()->sync([]);
        }

        if ($request->hasFile('image')) {
            $article->image_id = store_image($request);
        } else {
            $article->image_id = null;
        }

        $article->save();
    }

    public function updateArticle(ArticleUpdateRequest $request, Article $article, $data): void
    {
        $article->update($data);
        $article->update([
            'updated_by' => Auth::id(),
            'updated_at' => now(),
        ]);

        if (isset($data['categories'])) {
            $article->categories()->sync($data['categories']);
        } else {
            $article->categories()->sync(['math']);
        }

        if ($request->hasFile('image')) {
            $article->image_id = updateImage($request);
        }
        $article->save();
    }

    public function deleteArticle($article)
    {
        $article->deleted_by = Auth::id();
        $article->save();
        if ($article->image_id) {
            deleteImage($article);
        }
        $article->delete();
    }


}
