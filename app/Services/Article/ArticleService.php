<?php

namespace App\Services\Article;
use App\Models\Article;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArticleService
{

    public function getAllArticles(){
        return Article::all();
    }
    public function getAllCategories(){
        return Category::all();
    }

    public function getArticleById($articleId){
        return Article::findOrFail($articleId);
    }

    public function storeArticle($data) : void{

        $article = Article::create([
            'name' => $data['name'],
            'body' => $data['body'],
            'created_by' => auth()->id(),
        ]);

        if (isset($data['category_id'])) {
            $article->categories()->sync($data['category_id']);
        } else {
            $article->categories()->sync([]);
        }



        if (isset($data['image'])) {
            $article->image_id = $this->saveImage($data);
        }else{
            $article->image_id = null;
        }

        $article->save();



    }

    public function updateArticle(Article $article, $data): void
    {
        $article->update([
            'name' => $data['name'],
            'body' => $data['body'],
        ]);

        if (isset($data['image'])) {
            $article->image_id = $this->saveImage($data);
        }
        $article->save();
    }

    public function deleteArticle($articleId)
    {
        $article =$this->getArticleById($articleId);
        if ($article->image_id !== null) {
            Storage::disk('public')->delete($article->image()->path);
        }
        return $article->delete();

    }

    public function saveImage($data){
        $imagePath = $data['image']->store('articles', 'public');
        $imageSize = Storage::disk('public')->size($imagePath);
        $imageType = $data['image']->getClientMimeType();
        $imageName = $data['image']->getClientOriginalName();
        $imageExtension = $data['image']->getClientOriginalExtension();
        return Image::create([
            'name' => $imageName,
            'path' => $imagePath,
            'size' => $imageSize,
            'type' => $imageType,
            'extension' => $imageExtension,
        ])->id;
    }

}
