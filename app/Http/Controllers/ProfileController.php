<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Member;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    function AdminProfilePage(Request $request){

        $email = $request->session()->get('userEmail');
        $user = User::where('email', $email)->first();

        $member = Member::where("is_read", 0)->count();
        $contactMessage = ContactMessage::where("is_read", 0)->count();

        return Inertia::render("Auth/Profile/Profile",['user'=>$user,'member'=>$member,'contactMessage'=>$contactMessage]);
    }

    public function AdminProfileUpdate(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'password'=> 'required',
            ]);

            // Get the input values
            $name = $request->input('name');
            $slug = Str::slug($name);

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
                $imgPath = $image->storeAs('users', $imageName, 'public');
                $imgUrl = "/storage/" . $imgPath;
            }

            // Check if a book ID is passed (for updating an existing book)
            $user = User::find($request->input('id')); // Find the book by ID

            if ($user) {

                if($image){
                        // Update the existing book
                        $user->name = $name;
                        $user->email = $request->input('email');
                        $user->img = $imgUrl;
                        $user->password = bcrypt($request->input('password'));

                        $user->save();

                // Return success message
                return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Book updated successfully']);
                }else{

                        $user->name = $name;
                        $user->email = $request->input('email');
                        $user->password = bcrypt($request->input('password'));
                        $user->save();

                // Return success message
                return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Book updated successfully']);
                }
            }

        } catch (Exception $e) {
            return redirect()->back()->with('error', ['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
