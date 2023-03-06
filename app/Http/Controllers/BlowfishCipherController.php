<?php
namespace App\Http\Controllers;

use App\Algorithms\Blowfish;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class BlowfishCipherController extends Controller{
    function index(){
        if(Session::exists("data")) return view("symetricCiphers/blowfishCipher")->with(["data" => Session::get("data")]);
        return view("symetricCiphers/blowfishCipher");
    }

    function compute(Request $request){
        $timerStart = microtime(true);
        $data = $request->all();

        $bf = new Blowfish($data["key"]);

        if($data["action"] == "encrypt"){
           $data["finalText"] = base64_encode($bf->b_encrypt($data["text"]));
        }else{
            $data["finalText"] = $bf->b_decrypt(base64_decode($data["text"]));
        }

        //TODO add these variables
        $data["steps"] = "To be added";
        $data["iv"] = "To be added";



        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash("alert-info",trans("baseTexts.actionTook") . " ".$time_elapsed_secs . " s");
        Session::flash("data",$data);
        return redirect("blowfishCipher");
    }

    function hextobin($hexstr)
    {
        $n = strlen($hexstr);
        $sbin = "";
        $i = 0;
        while ($i < $n) {
            $a = substr($hexstr, $i, 2);
            $c = pack("H*", $a);
            if ($i == 0) {
                $sbin = $c;
            } else {
                $sbin .= $c;
            }
            $i += 2;
        }
        return $sbin;
    }
}
