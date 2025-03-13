<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BookLanguage;
use App\Models\MenuFooter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TrandingController extends Controller
{
    function index(){
        $menuFooter = MenuFooter::first();
        $languages = BookLanguage::orderBy('name', 'asc')->get();
        return Inertia::render('Tranding/Tranding',["menuFooter" => $menuFooter,"languages"=> $languages]);
    }
}
