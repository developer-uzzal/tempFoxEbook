<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookAuth;
use App\Models\BookLanguage;
use App\Models\MenuFooter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthorsController extends Controller
{

    function authorBooks($slug){
        $author = BookAuth::where('slug', $slug)->first();
        $book = Book::where('book_auth_id', $author->id)->get();

        $menuFooter = MenuFooter::first();
        $languages = BookLanguage::orderBy('name', 'asc')->get();


        return Inertia::render('AuthorBooks/AuthorBooks',["menuFooter" => $menuFooter,"languages"=> $languages, "book" => $book]);
    }
}
