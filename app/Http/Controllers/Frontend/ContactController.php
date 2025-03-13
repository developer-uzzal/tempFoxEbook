<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BookLanguage;
use App\Models\Contact;
use App\Models\MenuFooter;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    function index(){
        $menuFooter = MenuFooter::first();
        $list = Contact::first();
        $languages = BookLanguage::orderBy('name', 'asc')->get();
        return Inertia::render('Contact/Contact',["menuFooter" => $menuFooter,"list"=> $list,'languages'=>$languages]);
    }

    function AdminContactPage(Request $request){
        $user = User::where("email", $request->session()->get('userEmail'))->first();
        $list = Contact::first();
        return Inertia::render("Auth/Contact/Contact",["list"=> $list,"user"=> $user]);
    }

    public function AdminContactCreate(Request $request)
    {
        try {
            // Validate input fields
            $request->validate([
                'description' => 'required',
                'title' => 'required',
                'map' => 'required',
            ]);
    
            // Fetch existing Contact record
            $contact = Contact::first();
    
            // If no record exists, return an error (since we only update)
            if (!$contact) {
                return redirect()->back()->with('error', ['status' => 'error', 'message' => 'No Contact record found to update!']);
            }
    
            // Update title and description
            $contact->title = $request->input('title');
            $contact->description = $request->input('description');
            $contact->map = $request->input('map');

            // Save the updated record
            $contact->save();
    
            return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Contact details updated successfully']);
    
        } catch (Exception $e) {
            return redirect()->back()->with('error', ['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

}
