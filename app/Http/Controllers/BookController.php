<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookAuth;
use App\Models\BookLanguage;
use App\Models\Category;
use App\Models\Country;
use App\Models\publication;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;


class BookController extends Controller
{
    function AdminBookPage( Request $request){
        if($request->input("search")){
            $search = $request->input('search');
            $list = Book::where('title', 'like', '%' . $search . '%')->orderBy('id', 'desc')->paginate(10);
            $email = $request->session()->get('userEmail');
            $user = User::where('email', $email)->first();
            return Inertia::render("Auth/Book/BookList",['list' => $list,'user'=>$user]);
        }else{

            $list = Book::orderBy('id', 'desc')->paginate(10);
            $email = $request->session()->get('userEmail');
            $user = User::where('email', $email)->first();
            return Inertia::render("Auth/Book/BookList",['list' => $list,'user'=>$user]);

        }

    }

    function AdminBookCreatePage(Request $request){
        $country = Country::all();
        $category = Category::all();
        $language = BookLanguage::all();
        $author = BookAuth::all();
        $publication = publication::all();

        $email = $request->session()->get('userEmail');
        $user = User::where('email', $email)->first();
        return Inertia::render("Auth/Book/BookCreate",['countries' => $country, 'categories' => $category, 'languages' => $language, 'authors' => $author, 'publications' => $publication,'user'=>$user]);
    }

    function AdminBookCreate(Request $request){

        try {


            $request->validate([
                'title' => 'required|string',
                'isbn' => 'required|string',
                'publish_year' => 'required',
                'pageNumber' => 'required',
                'country_id' => 'required',
                'category_id' => 'required',
                'book_auth_id' => 'required',
                'book_language_id' => 'required',
                'publication_id' => 'required',
                'description' => 'required|string',
                'image' => 'required'
                ]);



                $title = $request->input('title');


                $slug = Str::slug($title);

                if(Book::where('slug', $slug)->exists()){
                    return redirect()->back()->with('error',['status' => 'error', 'message' => 'Book Already Exist!']);
                }


                $imgUrl = null;
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $extension = $image->getClientOriginalExtension(); // Get the file extension
                    $imageName = $slug . '-' . time() . '.' . $extension; // Unique filename
                    $imgPath = $image->storeAs('books', $imageName, 'public'); // Save in storage/app/public/books

                    $imgUrl = "/storage/" . $imgPath;
                }


                // Save Book
                $book = Book::create([
                    'title' => $title,
                    'slug' => $slug,
                    'isbn' => $request->input('isbn'),
                    'publish_year' => $request->input('publish_year'),
                    'pageNumber' => $request->input('pageNumber'),
                    'country_id' => $request->input('country_id'),
                    'category_id' => $request->input('category_id'),
                    'book_auth_id' => $request->input('book_auth_id'),
                    'book_language_id' => $request->input('book_language_id'),
                    'publication_id' => $request->input('publication_id'),
                    'description' => $request->input('description'),
                    'image' => $imgUrl,
                    'is_active' => $request->input('is_active'),
                    'is_trending' => $request->input('is_trending'),
                    'is_premium' => $request->input('is_premium'),

                ]);

                if($book){
                    return redirect()->back()->with('success',['status' => 'success', 'message' => 'Book created successfully']);
                    // return response ()->json(['status' => 'success', 'message' => 'Book created successfully']);
                }else{
                    return redirect()->back()->with('error',['status' => 'error', 'message' => 'Book create failed']);

                }


        }catch (Exception $e) {
            return redirect()->back()->with('error',['status' => 'error', 'message' => $e->getMessage()]);
            // return response ()->json(['status'=> 'error', 'message'=> $e->getMessage()]);
        }


    }

    function AdminBookUpdatePage($id,Request $request){
        $book = Book::findOrFail($id);

        $country = Country::all();
        $category = Category::all();
        $language = BookLanguage::all();
        $author = BookAuth::all();
        $publication = publication::all();

        $email = $request->session()->get('userEmail');
        $user = User::where('email', $email)->first();

        return Inertia::render('Auth/Book/BookEdit', ['list' => $book,'countries' => $country, 'categories' => $category, 'languages' => $language, 'authors' => $author, 'publications' => $publication,'user'=>$user]);

    }


    public function AdminBookUpdate(Request $request)
{
    try {
        // Validate the request
        $request->validate([
            'title' => 'required|string',
            'isbn' => 'required|string',
            'publish_year' => 'required',
            'pageNumber' => 'required',
            'country_id' => 'required',
            'category_id' => 'required',
            'book_auth_id' => 'required',
            'book_language_id' => 'required',
            'publication_id' => 'required',
            'description' => 'required|string',
        ]);

        // Get the input values
        $title = $request->input('title');
        $slug = Str::slug($title);

        // Initialize image URL
        $imgUrl = null;
        $image = $request->file('image');
        // If there's an image, handle it
        if ($request->hasFile('image')) {
            $oldImg = $request->input('oldImage');

            // Delete the old image if it exists
            if ($oldImg) {
                $oldImagePath = public_path($oldImg);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Handle the new image upload

            $extension = $image->getClientOriginalExtension();
            $imageName = $slug . '-' . time() . '.' . $extension;
            $imgPath = $image->storeAs('books', $imageName, 'public');
            $imgUrl = "storage/" . $imgPath;
        }

        // Check if a book ID is passed (for updating an existing book)
        $book = Book::find($request->id); // Find the book by ID

        if ($book) {

            if($image){
                    // Update the existing book
                    $book->title = $title;
                    $book->slug = $slug;
                    $book->isbn = $request->input('isbn');
                    $book->publish_year = $request->input('publish_year');
                    $book->pageNumber = $request->input('pageNumber');
                    $book->country_id = $request->input('country_id');
                    $book->category_id = $request->input('category_id');
                    $book->book_auth_id = $request->input('book_auth_id');
                    $book->book_language_id = $request->input('book_language_id');
                    $book->publication_id = $request->input('publication_id');
                    $book->description = $request->input('description');
                    $book->image = $imgUrl ; // Only update the image if a new one is uploaded
                    $book->is_active = $request->input('is_active');
                    $book->is_trending = $request->input('is_trending');
                    $book->is_premium = $request->input('is_premium');
                    $book->save();

            // Return success message
            return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Book updated successfully']);
            }else{
                // Update the existing book
            $book->title = $title;
            $book->slug = $slug;
            $book->isbn = $request->input('isbn');
            $book->publish_year = $request->input('publish_year');
            $book->pageNumber = $request->input('pageNumber');
            $book->country_id = $request->input('country_id');
            $book->category_id = $request->input('category_id');
            $book->book_auth_id = $request->input('book_auth_id');
            $book->book_language_id = $request->input('book_language_id');
            $book->publication_id = $request->input('publication_id');
            $book->description = $request->input('description');
            $book->is_active = $request->input('is_active');
            $book->is_trending = $request->input('is_trending');
            $book->is_premium = $request->input('is_premium');
            $book->save();

            // Return success message
            return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Book updated successfully']);
            }
        }

    } catch (Exception $e) {
        return redirect()->back()->with('error', ['status' => 'error', 'message' => $e->getMessage()]);
    }
}

    function AdminBookDelete(Request $request){
        try {
            $request->validate([
                'id' => 'required',
                'image' => 'required'
            ]);
            $book = Book::find($request->id);

            if($book){

                $img = $request->input('image');

                if($img){
                    Storage::disk('public')->delete($img);
                    $book->delete();
                    return redirect()->back()->with('success',['status' => 'success', 'message' => 'Book deleted successfully']);
                }


            }else{

                return redirect()->back()->with('error',['status'=> 'error','message'=> 'Book not found']);
            }

        } catch (Exception $e) {
            return redirect()->back()->with('error',['status' => 'error', 'message' => $e->getMessage()]);
        }
    }



}
