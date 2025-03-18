<?php
use App\Http\Controllers\BookAuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookLanguageController;
use App\Http\Controllers\BookPublicationController;
use App\Http\Middleware\AuthenticationMiddleaware;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\AuthorsController;
use App\Http\Controllers\Frontend\BookController as FrontendBookController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\DonateController;
use App\Http\Controllers\Frontend\FontCategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LanguagesController;
use App\Http\Controllers\Frontend\TrandingController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MenuFooterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/about',[AboutController::class, 'index'])->name('about');
Route::get('/author/{slug}',[AuthorsController::class, 'authorBooks'])->name('authors.books');
Route::get('/category/{slug}',[FontCategoryController::class, 'index'])->name('category');
Route::get('/book/language/{slug}',[LanguagesController::class, 'index'])->name('languages');
Route::get('/contact',[ContactController::class, 'index'])->name('contact');
Route::post('/contact/message',[ContactController::class, 'store'])->name('contact.message');
Route::get('/donate',[DonateController::class, 'index'])->name('donate');
Route::get('/download-book',[FrontendBookController::class,'bookDownload'])->name('book.download');
Route::post('/download-success',[FrontendBookController::class,'downloadIncrement'])->name('download.increment');
Route::post('/premium-members',[MemberController::class,'store'])->name('premium.members');

Route::get('/book/{slug}',[FrontendBookController::class,'SingleBook'])->name('SingleBook');


Route::get('/admin/login', [UserController::class, 'login'])->name('admin.login');
Route::post('/login', [UserController::class, 'userLogin'])->name('admin.UserLogin');
Route::get('/logout',[UserController::class,'userLogout']);

Route::get('/search/{search}',[HomeController::class, 'search'])->name('search');



Route::middleware([AuthenticationMiddleaware ::class])->group(function () {
    Route::get('/user-dashboard',[DashboardController::class, 'dashboard'])->name('Admin.dashboard');

    Route::get('/user-category',[ CategoryController ::class, 'AdminCategoryPage'])->name('Admin.category');
    Route::post('/user-category-create',[ CategoryController ::class, 'AdminCategoryCreate'])->name('Admin.category.create');
    Route::put('/user-category-update',[ CategoryController ::class, 'AdminCategoryUpdate'])->name('Admin.category.update');
    Route::delete('/user-category-delete',[ CategoryController ::class, 'AdminCategoryDelete'])->name('Admin.category.delete');



    Route::get('/user-books',[BookController::class, 'AdminBookPage'])->name('Admin.book');
    Route::get('/user-create-books',[BookController::class, 'AdminBookCreatePage'])->name('Admin.book.createPage');
    Route::post('/user-books-create',[ BookController ::class, 'AdminBookCreate'])->name('Admin.book.create');
    Route::get('/user-books-update/{id}',[ BookController ::class, 'AdminBookUpdatePage'])->name('Admin.book.book.updatePage');
    Route::post('/user-books-update',[ BookController ::class, 'AdminBookUpdate'])->name('Admin.book.book.update');
    Route::delete('/user-books-delete',[ BookController ::class, 'AdminBookDelete'])->name('Admin.book.book.delete');

    Route::get('/user-authors',[BookAuthController::class, 'AdminBookAuthPage'])->name('Admin.book.auth');
    Route::post('/user-authors-create',[ BookAuthController ::class, 'AdminAuthorCreate'])->name('Admin.author.create');
    Route::put('/user-authors-update',[ BookAuthController ::class, 'AdminAuthorUpdate'])->name('Admin.author.update');
    Route::delete('/user-authors-delete',[ BookAuthController ::class, 'AdminAuthorDelete'])->name('Admin.author.delete');

    Route::get('/user-publications',[BookPublicationController::class, 'AdminBookPublicationsPage'])->name('Admin.book.publications');
    Route::post('/user-publications-create',[ BookPublicationController ::class, 'AdminBookPublicationsCreate'])->name('Admin.book.publications.create');
    Route::put('/user-publications-update',[ BookPublicationController ::class, 'AdminBookPublicationsUpdate'])->name('Admin.book.publications.update');
    Route::delete('/user-publications-delete',[ BookPublicationController ::class, 'AdminBookPublicationsDelete'])->name('Admin.book.publications.delete');

    Route::get('/user-languages',[BookLanguageController::class, 'AdminBookLanguagesPage'])->name('Admin.book.languages');
    Route::post('/user-languages-create',[ BookLanguageController ::class, 'AdminBookLanguagesCreate'])->name('Admin.book.languages.create');
    Route::put('/user-languages-update',[ BookLanguageController ::class, 'AdminBookLanguagesUpdate'])->name('Admin.book.languages.update');
    Route::delete('/user-languages-delete',[ BookLanguageController ::class, 'AdminBookLanguagesDelete'])->name('Admin.book.languages.delete');

    Route::get('/user-books-country',[CountryController::class, 'AdminBookCountryPage'])->name('Admin.book.country');
    Route::post('/user-country-create',[ CountryController ::class, 'AdminBookCountryCreate'])->name('Admin.book.country.create');
    Route::put('/user-country-update',[ CountryController ::class, 'AdminBookCountryUpdate'])->name('Admin.book.country.update');
    Route::delete('/user-country-delete',[ CountryController ::class, 'AdminBookCountryDelete'])->name('Admin.book.country.delete');

    Route::get('/user-profile',[ProfileController::class, 'AdminProfilePage'])->name('Admin.profile');
    Route::post('/user-profile-update',[ ProfileController ::class, 'AdminProfileUpdate'])->name('Admin.profile.update');

    Route::get('/menu-footer',[MenuFooterController::class, 'AdminMenuFooterPage'])->name('Admin.menu.footer');
    Route::post('/user-menu-footer-create',[ MenuFooterController ::class, 'AdminMenuFooterCreate'])->name('Admin.menu.footer.create');

    Route::get('/user-about',[AboutController::class, 'AdminAboutPage']);
    Route::post('/user-about-create',[ AboutController::class, 'AdminAboutCreate']);

    Route::get('/user-contact',[ContactController::class, 'AdminContactPage']);
    Route::post('/user-contact-create',[ ContactController::class, 'AdminContactCreate']);

    Route::get('/user-slider',[HomeController::class, 'AdminSliderPage']);
    Route::post('/user-slider-create',[ HomeController::class, 'AdminSliderCreate']);

    Route::get('/new-updates-contact',[ContactController::class, 'AdminNewUpdatesContactPage']);
    Route::post('/admin/contact-news/update',[ContactController::class, 'AdminNewUpdatesContact']);
    Route::post('/admin/contact-new/update',[ContactController::class, 'AdminNewUpdatesContactNew']);




});
