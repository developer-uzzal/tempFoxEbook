<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookLanguage;
use App\Models\Category;
use App\Models\HomeBanner;
use App\Models\MenuFooter;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    function index(){
        $menuFooter = MenuFooter::first();
        $categories = Category::Where('is_active', 1)->orderBy('name', 'asc')->get();
        $languages = BookLanguage::orderBy('name', 'asc')->get();
        $banner = HomeBanner::first();
        $trending = Book::where('is_trending', 1)->orderBy('created_at', 'desc')->limit(6)->get();
        $latest = Book::where('is_active',1)->where('is_trending', 0)->orderBy('created_at', 'desc')->limit(18)->get();
        return Inertia::render('Home/Home',["menuFooter" => $menuFooter,"categories"=> $categories,'banner'=> $banner,'languages'=>$languages,'trending'=>$trending,'latest'=>$latest]);
    }

    function AdminSliderPage(Request $request){
        $email = $request->session()->get('userEmail');
        $user = User::where('email', $email)->first();
        $menuFooter = MenuFooter::first();
        $list = HomeBanner::first();
        return Inertia::render('Auth/Home/Home',["menuFooter" => $menuFooter,"list"=> $list,"user" => $user]);
    }

    function AdminSliderCreate(Request $request){
        try{
            $request->validate([
                'image' => 'required',
            ]);

            if($request->hasFile('image')){
                $oldImage = $request->input('oldImage');
                $newImage = $request->file('image');

                $extension = $newImage->getClientOriginalExtension();
                $imageName = 'slider' . '-' . time() . '.' . $extension;
                $imgPath = $newImage->storeAs('homeBanner', $imageName, 'public');
                $imgUrl = "storage/".$imgPath;

                if($oldImage){

                    if ($oldImage) {
                        $oldImagePath = public_path($oldImage);
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }

                }

                $slider = HomeBanner::first();
                $slider->img = $imgUrl;
                $slider->save();

                return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Banner Image updated successfully']);

            }

        }catch(Exception $e ){
            return redirect()->back()->with('error', ['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
