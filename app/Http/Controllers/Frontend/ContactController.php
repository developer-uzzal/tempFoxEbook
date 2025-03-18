<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BookLanguage;
use App\Models\Contact;
use App\Models\ContactMessage;
use App\Models\Member;
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

    function store(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'subject' => 'required',
        ]);
        $contact = ContactMessage::create($request->all());
        if($contact){
            return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Message sent successfully! We will get back to you soon.']);
        }else{
            return redirect()->back()->with('error', ['status'=> 'error','message'=> 'Something went wrong! Please try again.']);
        }
       
    }

    function AdminNewUpdatesContactPage(Request $request){
        $contactMessages = ContactMessage::get(); 
        $bookRequest = Member::get();
        $member = Member::where("is_read", 0)->count();
        $contactMessage = ContactMessage::where("is_read", 0)->count();
        $user = User::where("email", $request->session()->get('userEmail'))->first();
        return Inertia::render('Auth/ContactNews/ContactNews', ['contactMessageInfo' => $contactMessages, 'bookRequest' => $bookRequest, 'user' => $user, 'member' => $member, 'contactMessage' => $contactMessage]);



    }

    function AdminNewUpdatesContact(Request $request){

        $id = $request->id;

        $member = Member::where('id', $id)->first();

        if($member){
            $isRead = $member->is_read;
            if($isRead == 0){
                $member->is_read = 1;
                $member->save();
                return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Update successfully']);
            }else{
                $member->is_read = 0;
                $member->save();
                return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Update successfully']);
            }
            
            
        }else{
            return redirect()->back()->with('error', ['status'=> 'error','message'=> 'Something went wrong! Please try again.']);
        }
    }

    function AdminNewUpdatesContactNew(Request $request){

        $id = $request->id;

        $member = ContactMessage::where('id', $id)->first();

        if($member){
            $isRead = $member->is_read;
            if($isRead == 0){
                $member->is_read = 1;
                $member->save();
                return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Update successfully']);
            }else{
                $member->is_read = 0;
                $member->save();
                return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Update successfully']);
            }
            
            
        }else{
            return redirect()->back()->with('error', ['status'=> 'error','message'=> 'Something went wrong! Please try again.']);
        }
    }

}
