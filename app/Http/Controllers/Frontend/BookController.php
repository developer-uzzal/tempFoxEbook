<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookLanguage;
use App\Models\MenuFooter;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    public function bookDownload(Request $request)
    {

        // $filePath = $request->file;

        // // storage/pdf/et-qui-qui-in-aut-vo-1742206387.jpg
        // if (!Storage::disk('public')->exists($filePath)) {

        //     return response()->json(['error' => 'File not found'], 404);
        // }

        // return Storage::disk('public')->download($filePath, "book.pdf");


        $filePath = $request->file;
        
        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }
        
        return response()->streamDownload(function () use ($filePath) {
            echo Storage::disk('public')->get($filePath);
        }, basename($filePath));
    }

    function downloadIncrement(Request $request)
    {
        $name = $request->input('name');
        $name = "/storage/" . $name;

        $book = Book::where("file", $name)->firstOrFail();
        $book->download = $book->download + 1;
        $book->save();
    }
}
