<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\BookLanguage;
use App\Models\MenuFooter;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutController extends Controller
{
    function index(Request $request){
        $user = User::where("email", $request->session()->get('userEmail'))->first();
        $menuFooter = MenuFooter::first();
        $list = About::first();
        $languages = BookLanguage::orderBy('name', 'asc')->get();
        return Inertia::render('About/About',["menuFooter" => $menuFooter,"user"=> $user,"list"=> $list,'languages'=>$languages]);
    }

    function AdminAboutPage(Request $request){
        $user = User::where("email", $request->session()->get('userEmail'))->first();
        $list = About::first();
        return Inertia::render("Auth/About/About",["list"=> $list,"user"=> $user]);
    }

    public function AdminAboutCreate(Request $request)
{
    try {
        // Validate input fields
        $request->validate([
            'description' => 'required',
            'title' => 'required',
        ]);

        // Fetch existing About record
        $about = About::first();

        // If no record exists, return an error (since we only update)
        if (!$about) {
            return redirect()->back()->with('error', ['status' => 'error', 'message' => 'No About record found to update!']);
        }

        // Update title and description
        $about->title = $request->title;
        $about->long_des = $request->description;

        // Loop through images 1-4 and update them if provided
        for ($i = 1; $i <= 4; $i++) {
            $imageField = "image{$i}";
            $oldImageField = "oldImage{$i}";

            if ($request->hasFile($imageField)) {
                // Delete old image if it exists
                if ($about->{$imageField}) {
                    $oldImagePath = public_path($about->{$imageField});
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Upload new image
                $newImage = $request->file($imageField);
                $imgExtension = $newImage->getClientOriginalExtension();
                $imgName = "about{$i}-" . time() . "." . $imgExtension;
                $imgPath = $newImage->storeAs("about", $imgName, "public");

                // Save new image path in the database
                $about->{$imageField} = "storage/" . $imgPath;
            }
        }

        // Save the updated record
        $about->save();

        return redirect()->back()->with('success', ['status' => 'success', 'message' => 'About details updated successfully']);

    } catch (Exception $e) {
        return redirect()->back()->with('error', ['status' => 'error', 'message' => $e->getMessage()]);
    }
}

}
