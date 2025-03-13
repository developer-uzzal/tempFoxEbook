<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookLanguage;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function dashboard(Request $request) {
        $bookCount = Book::count();
        $categoryCount = Category::count();
        $email = $request->session()->get('userEmail');
        $user = User::where('email', $email)->first();

        return Inertia::render('Auth/Dashboard',['bookCount'=> $bookCount,'categoryCount'=> $categoryCount,'user'=>$user]);
    }
}
