<?php

use App\Http\Controllers\MainPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainPageController::class,"index"])->name("mainPage");
Route::get('language/{locale}', function ($locale) {
    if($locale == "cz"){
        Session::flash("alert-success", "Úspěšně jsi změnil jazyk na češtinu");
    }else{
        Session::flash("alert-success", "You have successfully changed your language to english");
    }
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name("changeLang");
