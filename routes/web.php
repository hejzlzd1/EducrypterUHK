<?php

use App\Http\Controllers\CaesarCipherController;
use App\Http\Controllers\MainPageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
        Session::flash("alert-info", "Click on english flag to revert language selection");
    }else{
        Session::flash("alert-success", "You have successfully changed your language to english");
        Session::flash("alert-info", "Klikni na českou vlajku, pokud chceš vrátit český jazyk");
    }
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name("changeLang");
Route::get("caesarCipher",[CaesarCipherController::class,"index"])->name("caesarCipher");
Route::post("caesarCipher",[CaesarCipherController::class,"compute"])->name("caesarCipherCompute");
