<?php

use App\Http\Controllers\A5_1CipherController;
use App\Http\Controllers\AesCipherController;
use App\Http\Controllers\BlowfishCipherController;
use App\Http\Controllers\CaesarCipherController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\RsaCipherController;
use App\Http\Controllers\SimpleDesCipherController;
use App\Http\Controllers\VigenereCipherController;
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

// Main page
Route::get('/', [MainPageController::class, 'index'])->name('mainPage');

// Language swap
Route::get('language/{locale}', function ($locale) {
    if ($locale == 'cz') {
        Session::flash('alert-success', 'Úspěšně jsi změnil jazyk na češtinu');
        Session::flash('alert-info', 'Click on english flag to revert language selection');
    } else {
        Session::flash('alert-success', 'You have successfully changed your language to english');
        Session::flash('alert-info', 'Klikni na českou vlajku, pokud chceš vrátit český jazyk');
    }
    app()->setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();
})->name('changeLang');

// Symmetrical ciphers

// CaesarCipher
Route::get('caesarCipher', [CaesarCipherController::class, 'index'])->name('caesarCipher');
Route::post('caesarCipher', [CaesarCipherController::class, 'compute'])->name('caesarCipherCompute');

// VigenereCipher
Route::get('vigenereCipher', [VigenereCipherController::class, 'index'])->name('vigenereCipher');
Route::post('vigenereCipher', [VigenereCipherController::class, 'compute'])->name('vigenereCipherCompute');

// BlowfishCipher
Route::get('blowfishCipher', [BlowfishCipherController::class, 'index'])->name('blowfishCipher');
Route::post('blowfishCipher', [BlowfishCipherController::class, 'compute'])->name('blowfishCipherCompute');

Route::get('aesCipher', [AesCipherController::class, 'index'])->name('aesCipher');
Route::post('aesCipher', [AesCipherController::class, 'compute'])->name('aesCipherCompute');

Route::get('simpleDesCipher', [SimpleDesCipherController::class, 'index'])->name('simpleDesCipher');
Route::post('simpleDesCipher', [SimpleDesCipherController::class, 'compute'])->name('simpleDesCipherCompute');

// Asymmetrical ciphers

Route::get('rsaCipher', [RsaCipherController::class, 'index'])->name('rsaCipher');
Route::post('rsaCipher', [RsaCipherController::class, 'compute'])->name('rsaCipherCompute');

Route::get('a51', [A5_1CipherController::class, 'index'])->name('a51');
Route::post('a51', [A5_1CipherController::class, 'compute'])->name('a51Compute');
