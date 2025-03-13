<?php

namespace App\Http\Controllers;

use App\Models\MenuFooter;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuFooterController extends Controller
{
    function AdminMenuFooterPage(Request $request){
        $user = User::where("email", $request->session()->get('userEmail'))->first();
        $list = MenuFooter::first();
        return Inertia::render("Auth/MenuFooter/MenuFooter",["user" => $user, "list" => $list]);
        
    }

    function AdminMenuFooterCreate(Request $request){
        
        try {
            
            // Get the input values
            $slug = 'logo';
    
            // Initialize image URL
            $imgUrl = null;
            $image = $request->file('logo');

            $faviconUrl = null;
            $favicon = $request->file("favicon");
            // If there's an image, handle it
            if ($request->hasFile('logo')) {
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
                $imgPath = $image->storeAs('menuFooter', $imageName, 'public');
                $imgUrl = "storage/" . $imgPath;

                $menuFooter = MenuFooter::first();

                $menuFooter->logo = $imgUrl;
                $menuFooter->title = $request->title;
                $menuFooter->short_des = $request->short_description;
                $menuFooter->address = $request->address;
                $menuFooter->phone = $request->phone;
                $menuFooter->email = $request->email;
                $menuFooter->facebook = $request->facebook;
                $menuFooter->twitter = $request->twitter;
                $menuFooter->youtube = $request->youtube;
                $menuFooter->year = $request->copy_right_year;
                $menuFooter->copy_right = $request->copy_right;
                $menuFooter->save();

            return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Book updated successfully']);

            }else{

                if($request->hasFile("favicon")){
                    $oldFav = $request->input('oldFavicon');
                    
                    // Delete the old image if it exists
                    if ($oldFav) {
                        $oldFavPath = public_path($oldFav);
                        if (file_exists($oldFavPath)) {
                            unlink($oldFavPath);
                        }
                    }
    
                    $faviconExtension = $favicon->getClientOriginalExtension();
                    $faviconName = "favicon-" . time() . "." . $faviconExtension;
                    $faviconPath = $favicon->storeAs("menuFooter", $faviconName, "public");
                    $faviconUrl = "storage/" . $faviconPath;
    
                    $menuFooter = MenuFooter::first();
                    $menuFooter->fav_icon = $faviconUrl;
                    $menuFooter->title = $request->title;
                    $menuFooter->short_des = $request->short_description;
                    $menuFooter->address = $request->address;
                    $menuFooter->phone = $request->phone;
                    $menuFooter->email = $request->email;
                    $menuFooter->facebook = $request->facebook;
                    $menuFooter->twitter = $request->twitter;
                    $menuFooter->youtube = $request->youtube;
                    $menuFooter->year = $request->copy_right_year;
                    $menuFooter->copy_right = $request->copy_right;
                    $menuFooter->save();
                    return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Book updated successfully']);
                }
                
                $menuFooter = MenuFooter::first();
                $menuFooter->title = $request->title;
                $menuFooter->short_des = $request->short_description;
                $menuFooter->address = $request->address;
                $menuFooter->phone = $request->phone;
                $menuFooter->email = $request->email;
                $menuFooter->facebook = $request->facebook;
                $menuFooter->twitter = $request->twitter;
                $menuFooter->youtube = $request->youtube;
                $menuFooter->year = $request->copy_right_year;
                $menuFooter->copy_right = $request->copy_right;
                $menuFooter->save();
                return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Book updated successfully']);
            }

    
        } catch (Exception $e) {
            return redirect()->back()->with('error', ['status' => 'error', 'message' => $e->getMessage()]);
        }

        
    }
}
