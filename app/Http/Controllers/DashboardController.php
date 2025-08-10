<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $numberOfArticles = Article::count();
        $numberOfCategories = Category::count();
        $numberOfUsers = User::count();

        $categories = Category::all();


        $articlesNumber = array();
        foreach ($categories as $category) {
             $articlesNumber[$category->name] = $category->articles()->count();
        }
        $categoriesName= array();
        $x = 0;
        foreach ($categories as $category) {
            $categoriesName[$x] = $category->name;
            $x++;
        }

        return view('dashboard',compact(['numberOfArticles','numberOfCategories','numberOfUsers','categoriesName','articlesNumber']));
    }

}
