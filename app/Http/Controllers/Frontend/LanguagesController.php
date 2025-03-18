<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BookLanguage;
use App\Models\MenuFooter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LanguagesController extends Controller
{
    function index(Request $request,$slug){
        $slug = $slug;
        
        $book = BookLanguage::where("slug",$slug)->with('book')->first();
        $menuFooter = MenuFooter::first();
        $languages = BookLanguage::orderBy('name', 'asc')->get();
        return Inertia::render('Languages/Languages',["menuFooter" => $menuFooter,"languages"=> $languages,"book"=> $book]);
    }
}
