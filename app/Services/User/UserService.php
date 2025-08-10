<?php

namespace App\Services\User;

use App\Models\Category;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class UserService
{

    public function getAllArticleForAdmin(){
        return Article::orderBy('created_at', 'desc')
            ->paginate(6);
    }

    public function getUserArticles(User $user)
    {
        if(auth()->id() !== $user->id)
            return route('user.show', auth()->id());
        if($user->role === 'admin')
            return $this->getAllArticleForAdmin();

        return Article::where('created_by', $user->id)->orderBy('created_at', 'desc')
        ->paginate(6);
    }
    public function getAllUsers()
    {
        return User::all();
    }
    public function getUserCategories(User $user)
    {
        return $user->categoriesCreator()->paginate(3);
    }
    public function getAllCategoriesForAdmin(User $user)
    {
        return Category::orderBy('created_at', 'desc')
            ->paginate(3);
    }
    public function updateUser(User $user,  $data)
    {
        $user->update($data);
        $user->updated_by = Auth::id();
        $user->updated_at = now();

        $user->save();
        return $user;
    }
    public function destroyUser(User $user)
    {
        if($user->categoriesCreator()->count() > 0){
            return false;
        }
        $user->deleted_by = Auth::id();
        $user->save();

        $user->delete();
        return true;
    }
}
