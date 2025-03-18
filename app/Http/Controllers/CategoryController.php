<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Contact;
use App\Models\ContactMessage;
use App\Models\Member;
use App\Models\User;
use Exception;
use Inertia\Inertia;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function AdminCategoryPage(Request $request){

            $list = Category::orderby('updated_at', 'desc')->with('books')->get();
            $email = $request->session()->get('userEmail');
            $user = User::where('email', $email)->first();

            $member = Member::where("is_read", 0)->count();
            $contactMessage = ContactMessage::where("is_read", 0)->count();

            return Inertia::render("Auth/Category/CategoryList",['list' => $list,'user'=>$user,'member'=>$member,'contactMessage'=>$contactMessage]);

    }

    function AdminCategoryCreate(Request $request){

        $request->validate([
            'name' => 'required',
        ]);

        $title = $request->input('name');
        $slug = Str::slug($title);


        if(Category::where('slug', $slug)->exists()){
            return redirect()->back()->with('error',['status' => 'error', 'message' => 'Category already exists']);
        }else{
            $newCategory = Category::create([
                'name' => $title,
                'slug' => $slug,
                'is_active' => $request->input('status'),
            ]);

            if($newCategory){
                return redirect()->back()->with('success',['status' => 'success', 'message' => 'Category created successfully']);
            }else{
                return redirect()->back()->with('error',['status' => 'error', 'message' => 'Category creation failed']);
            }
        }



    }

    function AdminCategoryUpdate(Request $request){
        try {

            $request->validate([
                'name' => 'required',
            ]);

            $title = $request->input('name');
            $slug = Str::slug($title);

            $category = Category::find($request->id);
            $category->name = $title;
            $category->slug = $slug;
            $category->is_active = $request->input('status');
            $category->save();

            if($category){
                return redirect()->back()->with('success',['status' => 'success', 'message' => 'Category updated successfully']);
            }else{
                return redirect()->back()->with('error',['status' => 'error', 'message' => 'Category update failed']);
            }

        }catch (Exception $e) {

            return redirect()->back()->with('error',['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    function AdminCategoryDelete(Request $request){
        try {
            $request->validate([
                'id' => 'required',
            ]);
            $category = Category::find($request->id);
            $category->delete();
            return redirect()->back()->with('success',['status' => 'success', 'message' => 'Category deleted successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with('error',['status' => 'error', 'message' => $e->getMessage()]);
        }
    }



}
