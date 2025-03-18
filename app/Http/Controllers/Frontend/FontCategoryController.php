<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookLanguage;
use App\Models\Category;
use App\Models\MenuFooter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FontCategoryController extends Controller
{
    function index($slug){
        $category = Category::where('slug', $slug)->first();
        $book = Book::where('category_id', $category->id)->get();
        $menuFooter = MenuFooter::first();
        $languages = BookLanguage::orderBy('name', 'asc')->get();
        return Inertia::render('Category/Category',["menuFooter" => $menuFooter,"languages"=> $languages, "book" => $book]);
    }
}
