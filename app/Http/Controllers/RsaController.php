<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class RsaController extends Controller{
    function index(){
        if(Session::exists("data")) return view("asymmetricCiphers/rsaCipher")->with(["data" => Session::get("data")]);

        Session::flash("alert-warning", trans("baseTexts.notReady"));
        //return redirect()->back();

        return view("asymmetricCiphers/rsaCipher");
    }
}
