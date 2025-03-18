<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookAuth;
use App\Models\ContactMessage;
use App\Models\Member;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class BookAuthController extends Controller
{
    function AdminBookAuthPage(Request $request){

            $list = BookAuth::orderBy('id', 'desc')->get();
            $email = $request->session()->get('userEmail');
            $user = User::where('email', $email)->first();

            $member = Member::where("is_read", 0)->count();
            $contactMessage = ContactMessage::where("is_read", 0)->count();
            return Inertia::render("Auth/BookAuthor/BookAuthor",['list' => $list,'user'=>$user,'member'=>$member,'contactMessage'=>$contactMessage]);

    }



    function AdminAuthorCreate(Request $request){

        $request->validate([
            'name' => 'required',
        ]);

        $title = $request->input('name');
        $slug = Str::slug($title);

        if(BookAuth::where('slug', $slug)->exists()){
            return redirect()->back()->with('error',['status' => 'error', 'message' => 'Book author already exists']);
        }else{
            $newBookAuthor = BookAuth::create([
                'name' => $title,
                'slug' => $slug,
            ]);

            if($newBookAuthor){
                return redirect()->back()->with('success',['status' => 'success', 'message' => 'Book author created successfully']);
            }else{
                return redirect()->back()->with('error',['status' => 'error', 'message' => 'Book author creation failed']);
            }
        }



    }

    function AdminAuthorUpdate(Request $request){
        try {

            $request->validate([
                'name' => 'required',
            ]);

            $title = $request->input('name');
            $slug = Str::slug($title);

            $auth = BookAuth::find($request->id);
            $auth->name = $title;
            $auth->slug = $slug;
            $auth->save();

            if($auth){
                return redirect()->back()->with('success',['status' => 'success', 'message' => 'Book author updated successfully']);
            }else{
                return redirect()->back()->with('error',['status' => 'error', 'message' => 'Book author update failed']);
            }

        }catch (Exception $e) {

            return redirect()->back()->with('error',['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    function AdminAuthorDelete(Request $request){
        try {
            $request->validate([
                'id' => 'required',
            ]);
            $author = BookAuth::find($request->id);
            $author->delete();
            return redirect()->back()->with('success',['status' => 'success', 'message' => 'Book author deleted successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with('error',['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

}
