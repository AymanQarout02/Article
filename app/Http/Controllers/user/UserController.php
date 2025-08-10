<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use  App\Services\User\UserService;
use Illuminate\View\View;

class UserController extends Controller
{

    public UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $user = $this->userService->getAllUsers();
        return view('user.index', ['users' => $user]);
    }

    public function show(User $user){
        $articles = $this->userService->getUserArticles($user);
        return view('user.show', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    public function categories(User $user)
    {

        if($user->role === 'admin')
            $categories = $this->userService->getAllCategoriesForAdmin($user);
        else
            $categories = $this->userService->getUserCategories($user);
        return view('user.categories', [
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function update(User $user , UserRequest $request)
    {
        $this->userService->updateUser($user, $request->validated());
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $deleted = $this->userService->destroyUser($user);

        if($deleted)
            return redirect()->route('user.index')->with('success', 'User deleted successfully.');
        else
            return redirect()->route('user.index')->with('error', 'User cannot be deleted because it has associated categories.');
    }

}
