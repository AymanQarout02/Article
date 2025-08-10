<?php

use App\Http\Requests\Article\ArticleCreateRequest;
use App\Http\Requests\Article\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

if (! function_exists('store_image')) {
    function store_image(ArticleCreateRequest $request)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $imageSize = Storage::disk('public')->size($imagePath);
            $imageType = $request->file('image')->getClientMimeType();
            $imageName = $request->file('image')->getClientOriginalName();
            $imageExtension = $request->file('image')->getClientOriginalExtension();

            return Image::create([
                'name' => $imageName,
                'path' => $imagePath,
                'size' => $imageSize,
                'type' => $imageType,
                'extension' => $imageExtension,
                'created_by' => Auth::id(),
            ])->id;
        } else {
           return null;
        }
    }
}
if (! function_exists('updateImage')) {
    function updateImage(ArticleUpdateRequest $request)
    {
        if( !$request->hasFile('image')) {
            return null;
        }
        $imagePath = $request->file('image')->store('articles', 'public');
        $imageSize = Storage::disk('public')->size($imagePath);
        $imageType = $request->file('image')->getClientMimeType();
        $imageName = $request->file('image')->getClientOriginalName();
        $imageExtension = $request->file('image')->getClientOriginalExtension();

        return Image::create([
            'name' => $imageName,
            'path' => $imagePath,
            'size' => $imageSize,
            'type' => $imageType,
            'extension' => $imageExtension,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
            'updated_at' => now(),
        ])->id;

    }
}
if (! function_exists('deleteImage')) {
    function deleteImage(Article $article)
    {
        $article->image->deleted_by = Auth::id();
        $article->image->save();
        $article->image()->delete();
    }
}




