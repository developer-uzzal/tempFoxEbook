<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookLanguage;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function dashboard(Request $request) {
        $bookCount = Book::count();
        $downloadCount = Book::sum('download');
        $categoryCount = Category::count();
        $email = $request->session()->get('userEmail');
        $user = User::where('email', $email)->first();

        $member = Member::where("is_read", 0)->count();
        $contactMessage = ContactMessage::where("is_read", 0)->count();

        return Inertia::render('Auth/Dashboard',['bookCount'=> $bookCount,'categoryCount'=> $categoryCount,'user'=>$user,'downloadCount'=>$downloadCount,'member'=>$member,'contactMessage'=>$contactMessage]);
    }
}
