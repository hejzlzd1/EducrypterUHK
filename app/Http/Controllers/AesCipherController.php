<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class AesCipherController extends Controller
{
    function index()
    {
        if (Session::exists("data")) return view("symetricCiphers/aesCipher")->with(["data" => Session::get("data")]);
        return view("symetricCiphers/aesCipher");
    }

    function compute(Request $request)
    {
        $timerStart = microtime(true);
        $data = $request->all();

        $ivText = "LHG0xiZoQHusxqsdwadLQe";
        $iv = base64_decode($ivText);
        $bits = $data["bits"];

        $data["iv"] = $ivText;
        if ($data["action"] == "encrypt") {
            $data["finalText"] = base64_encode(openssl_encrypt(bin2hex($data["text"]), "aes".$bits, bin2hex($data["key"]), 1, $iv));
        } else {
            $data["finalText"] = $this->hextobin(openssl_decrypt(base64_decode($data["text"]), "aes".$bits, bin2hex($data["key"]), 1, $iv));
        }

        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash("alert-info",trans("baseTexts.actionTook") . " ".$time_elapsed_secs . " s");
        Session::flash("data",$data);
        return redirect("aesCipher");
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
