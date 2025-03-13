<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BookLanguage;
use App\Models\MenuFooter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DonateController extends Controller
{
    function index(){
        $menuFooter = MenuFooter::first();
        $languages = BookLanguage::orderBy('name', 'asc')->get();
        return Inertia::render('Donate/Donate',["menuFooter" => $menuFooter,"languages"=> $languages]);
    }
}
