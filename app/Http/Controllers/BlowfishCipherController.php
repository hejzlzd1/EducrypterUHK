<?php
namespace App\Http\Controllers;

use App\Algorithms\Blowfish;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class BlowfishCipherController extends Controller{
    function index(){
        if(Session::exists("data")) return view("symmetricCiphers/blowfishCipher")->with(["data" => Session::get("data")]);
        return view("symmetricCiphers/blowfishCipher");
    }

    function compute(Request $request){
        $timerStart = microtime(true);
        $data = $request->all();
        if(!is_string($data["key"]) || empty($data["key"])){
            Session::flash("alert-error",trans("baseTexts.keyCannotBeEmpty"));
            return redirect("blowfishCipher");
        }
        if(!is_string($data["text"]) || empty($data["text"])){
            Session::flash("alert-error",trans("baseTexts.textCannotBeEmpty"));
            return redirect("blowfishCipher");
        }
        if(empty($data["action"])){
            Session::flash("alert-error",trans("baseTexts.actionCannotBeEmpty"));
            return redirect("blowfishCipher");
        }

        $bf = new Blowfish($data["key"]);

        $data["action"] == "encrypt" ? $data["finalText"] = base64_encode($bf->encrypt($data["text"])) : $data["finalText"] = $bf->decrypt(base64_decode($data["text"]));

        $data["steps"] = $bf->getStepsOfAlgorithm();
        $data["inputSize"] = $bf->getInputSize();
        $data["subkeys"] = $bf->getSubkeys();



        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash("alert-info",trans("baseTexts.actionTook") . " ".$time_elapsed_secs . " s");
        Session::flash("data",$data);
        return redirect("blowfishCipher");
    }

}
