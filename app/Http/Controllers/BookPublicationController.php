<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class BookPublicationController extends Controller
{
    function AdminBookPublicationsPage(Request $request){

        if($request->input("search")){
            $search = $request->input('search');
            $list = Publication::where('name', 'like', '%' . $search . '%')->orderBy('id', 'desc')->paginate(10);
            $email = $request->session()->get('userEmail');
            $user = User::where('email', $email)->first();
            return Inertia::render("Auth/BookPublications/Publication",['list' => $list,'user'=>$user]);
        }else{

            $list = Publication::orderBy('id', 'desc')->paginate(10);
            $email = $request->session()->get('userEmail');
            $user = User::where('email', $email)->first();
            return Inertia::render("Auth/BookPublications/Publication",['list' => $list,'user'=>$user]);

        }

    }


    function AdminBookPublicationsCreate(Request $request){

        $request->validate([
            'name' => 'required',
        ]);

        $title = $request->input('name');
        $slug = Str::slug($title);

        if(Publication::where('slug', $slug)->exists()){
            return redirect()->back()->with('error',['status' => 'error', 'message' => 'Publication already exists']);
        }else{
            $newBookAuthor = Publication::create([
                'name' => $title,
                'slug' => $slug,
            ]);

            if($newBookAuthor){
                return redirect()->back()->with('success',['status' => 'success', 'message' => 'Publication created successfully']);
            }else{
                return redirect()->back()->with('error',['status' => 'error', 'message' => 'Publication creation failed']);
            }
        }



    }

    function AdminBookPublicationsUpdate(Request $request){
        try {

            $request->validate([
                'name' => 'required',
            ]);

            $title = $request->input('name');
            $slug = Str::slug($title);

            $auth = Publication::find($request->id);
            $auth->name = $title;
            $auth->slug = $slug;
            $auth->save();

            if($auth){
                return redirect()->back()->with('success',['status' => 'success', 'message' => 'Publication updated successfully']);
            }else{
                return redirect()->back()->with('error',['status' => 'error', 'message' => 'Publication update failed']);
            }

        }catch (Exception $e) {

            return redirect()->back()->with('error',['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    function AdminBookPublicationsDelete(Request $request){
        try {
            $request->validate([
                'id' => 'required',
            ]);
            $author = Publication::find($request->id);
            $author->delete();
            return redirect()->back()->with('success',['status' => 'success', 'message' => 'Publication deleted successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with('error',['status' => 'error', 'message' => $e->getMessage()]);
        }
    }


}
