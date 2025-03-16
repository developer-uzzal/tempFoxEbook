<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookLanguage;
use App\Models\MenuFooter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    function SingleBook(Request $request, $slug)
    {
        $slug = $slug;

        $menuFooter = MenuFooter::first();
        $languages = BookLanguage::orderBy('name', 'asc')->get();

        $book = Book::whereSlug($slug)->with('category')->with('bookAuth')->with('bookLanguage')->with('publication')->with('country')->first();
        
        // Check if book is found
        if ($book) {
            $relatedBooks = Book::where('category_id', $book->category_id)
                ->where('id', '!=', $book->id)
                ->limit(6)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // Handle the case when book is not found, for example:
            $relatedBooks = collect(); // or show an error message
        }

        return Inertia::render('SingleBook/SingleBook', [
            'book' => $book,
            'menuFooter' => $menuFooter,
            'languages' => $languages,
            'relatedBooks' => $relatedBooks
        ]);
    }
}
