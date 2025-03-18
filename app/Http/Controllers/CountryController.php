<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Country;
use App\Models\Member;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

use function Pest\Laravel\get;

class CountryController extends Controller
{
    function AdminBookCountryPage(Request $request){
            $email = $request->session()->get('userEmail');
            $list = Country::orderBy('id', 'desc')->get();
            $email = $request->session()->get('userEmail');
            $user = User::where('email', $email)->first();

            $member = Member::where("is_read", 0)->count();
            $contactMessage = ContactMessage::where("is_read", 0)->count();
            return Inertia::render("Auth/BookCountry/BookCountryList",['list' => $list, 'user' => $user,'member'=> $member,'contactMessage'=> $contactMessage]);


    }

    function AdminBookCountryCreate(Request $request){

        $request->validate([
            'name' => 'required',
        ]);

        $title = $request->input('name');
        $slug = Str::slug($title);

        if(Country::where('slug', $slug)->exists()){
            return redirect()->back()->with('error',['status' => 'error', 'message' => 'Country already exists']);
        }else{
            $newBookAuthor = Country::create([
                'name' => $title,
                'slug' => $slug,
            ]);

            if($newBookAuthor){
                return redirect()->back()->with('success',['status' => 'success', 'message' => 'Country created successfully']);
            }else{
                return redirect()->back()->with('error',['status' => 'error', 'message' => 'Country creation failed']);
            }
        }



    }

    function AdminBookCountryUpdate(Request $request){
        try {

            $request->validate([
                'name' => 'required',
            ]);

            $title = $request->input('name');
            $slug = Str::slug($title);

            $auth = Country::find($request->id);
            $auth->name = $title;
            $auth->slug = $slug;
            $auth->save();

            if($auth){
                return redirect()->back()->with('success',['status' => 'success', 'message' => 'Country updated successfully']);
            }else{
                return redirect()->back()->with('error',['status' => 'error', 'message' => 'Country update failed']);
            }

        }catch (Exception $e) {

            return redirect()->back()->with('error',['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    function AdminBookCountryDelete(Request $request){
        try {
            $request->validate([
                'id' => 'required',
            ]);
            $author = Country::find($request->id);
            $author->delete();
            return redirect()->back()->with('success',['status' => 'success', 'message' => 'Country deleted successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with('error',['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

}
