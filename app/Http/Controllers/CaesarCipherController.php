<?php

namespace App\Http\Controllers;

use App\Algorithms\Caesar;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class CaesarCipherController extends Controller
{
    public function index(): Factory|View|Application
    {
        if(Session::exists("data")) return view("symmetricCiphers/caesarCipher")->with(["data" => Session::get("data")]);
        return view("symmetricCiphers/caesarCipher");
    }

    public function compute(Request $request): Application|RedirectResponse|Redirector
    {
        $timerStart = microtime(true);
        $data = $request->all();

        if(!is_numeric($data["shift"])){
            Session::flash("alert-error",trans("baseTexts.keyCannotBeEmpty"));
            return redirect("caesarCipher");
        }
        if(!is_string($data["text"]) || empty($data["text"])){
            Session::flash("alert-error",trans("baseTexts.textCannotBeEmpty"));
            return redirect("caesarCipher");
        }
        if(empty($data["action"])){
            Session::flash("alert-error",trans("baseTexts.actionCannotBeEmpty"));
            return redirect("caesarCipher");
        }

        $caesarCipher = new Caesar($data["text"]);

        if($data["action"] != "bruteforce"){
            $data["finalText"] = $caesarCipher->performCaesar($data["shift"],$data["action"]);
            $data["shiftedAlphabet"] = $caesarCipher->rotateAlphabet($request->input("shift"));
        }else{
            $data["bruteForceResult"] = $caesarCipher->bruteForce();
            $data["shift"] = 0;
        }

        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash("alert-info",trans("baseTexts.actionTook") . " ".$time_elapsed_secs . " s");
        Session::flash("data",$data);
        return redirect("caesarCipher");
    }
}
