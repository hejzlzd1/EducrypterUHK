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
    function compute(Request $request){
        $timerStart = microtime(true);
        $data = $request->all();

        $firstInputNumber = $data["primeNumber1"];
        $secondInputNumber = $data["primeNumber2"];

        if($data["action"] == "encrypt"){
            //$data["finalText"] = base64_encode($bf->b_encrypt($data["text"]));
        }else{
            //$data["finalText"] = $bf->b_decrypt(base64_decode($data["text"]));
        }



        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash("alert-info",trans("baseTexts.actionTook") . " ".$time_elapsed_secs . " s");
        Session::flash("data",$data);
        return redirect("rsaCipher");
    }
}
