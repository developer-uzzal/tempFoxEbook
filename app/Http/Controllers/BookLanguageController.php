<?php

namespace App\Http\Controllers;

use App\Models\BookLanguage;
use App\Models\ContactMessage;
use App\Models\Member;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class BookLanguageController extends Controller
{
    function AdminBookLanguagesPage(Request $request){
            $list = BookLanguage::orderBy('id', 'desc')->get();
            $email = $request->session()->get('userEmail');
            $user = User::where('email', $email)->first();

            $member = Member::where("is_read", 0)->count();
            $contactMessage = ContactMessage::where("is_read", 0)->count();

            return Inertia::render("Auth/BookLanguages/Language",['list' => $list, 'user' => $user,'member'=> $member,'contactMessage'=> $contactMessage]);
    }

    function AdminBookLanguagesCreate(Request $request){

        $request->validate([
            'name' => 'required',
        ]);

        $title = $request->input('name');
        $slug = Str::slug($title);

        if(BookLanguage::where('slug', $slug)->exists()){
            return redirect()->back()->with('error',['status' => 'error', 'message' => 'Book language already exists']);
        }else{
            $newBookAuthor = BookLanguage::create([
                'name' => $title,
                'slug' => $slug,
            ]);

            if($newBookAuthor){
                return redirect()->back()->with('success',['status' => 'success', 'message' => 'Book language created successfully']);
            }else{
                return redirect()->back()->with('error',['status' => 'error', 'message' => 'Book language creation failed']);
            }
        }



    }

    function AdminBookLanguagesUpdate(Request $request){
        try {

            $request->validate([
                'name' => 'required',
            ]);

            $title = $request->input('name');
            $slug = Str::slug($title);

            $auth = BookLanguage::find($request->id);
            $auth->name = $title;
            $auth->slug = $slug;
            $auth->save();

            if($auth){
                return redirect()->back()->with('success',['status' => 'success', 'message' => 'Book language updated successfully']);
            }else{
                return redirect()->back()->with('error',['status' => 'error', 'message' => 'Book language update failed']);
            }

        }catch (Exception $e) {

            return redirect()->back()->with('error',['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    function AdminBookLanguagesDelete(Request $request){
        try {
            $request->validate([
                'id' => 'required',
            ]);
            $author = BookLanguage::find($request->id);
            $author->delete();
            return redirect()->back()->with('success',['status' => 'success', 'message' => 'Book language deleted successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with('error',['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
