<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Exception;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function store(Request $request)
    {
        
        try{

            $request->validate([
                'email'=> 'required',
                'message' => 'required',
            ]);

            $email = $request->input("email");
            $message = $request->input("message");
            
            $member = Member::create([
                "email" => $email,
                "info" => $message,
            ]);

            return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Message sent successfully! We will get back to you soon.']);

        }catch(Exception $e){
            
            return redirect()->back()->with('error', $e->getMessage());
        }
        

        
    }
}
