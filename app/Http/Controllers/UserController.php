<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class UserController extends Controller
{
    public function login()
    {
        return Inertia::render('Auth/Login');
    }

    public function userLogin(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {

            $user = User::where('email', $credentials['email'])->first();

            if ($user){

                if(Hash::check($credentials['password'], $user->password)) {
                    $request->session()->put('userEmail', $user->email);

                    return redirect('/user-dashboard')->with('success',['status' => 'success', 'message' => 'Login successfully']);
                }else {
                    return redirect()->back()->with('error', ['status'=> 'error','message'=> 'Password does not match']);

                }

            }else {
                return redirect()->back()->with('error', ['status'=> 'error','message'=> 'User not found']);
            }

            // Store user ID in session

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function userLogout(Request $request){

        $request->session()->forget('userEmail');
        return redirect()->route('admin.login');

    }
}

