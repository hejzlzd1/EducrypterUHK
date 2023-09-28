<?php

namespace App\Http\Controllers;

use App\Algorithms\CipherBase;
use App\Algorithms\Ciphers\Vigenere;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class VigenereCipherController extends Controller
{
    public function index()
    {
        if (Session::exists('data')) {
            return view('symmetricCiphers/vigenereCipher')->with(
                [
                    'data' => Session::get('data'), 'result' => Session::get('result')
                ]
            );
        }
        return view('symmetricCiphers/vigenereCipher');
    }

    public function compute(Request $request): Redirector|Application|RedirectResponse
    {
        $timerStart = microtime(true);
        $data = $request->all();

        if (!is_string($data['key']) || empty($data['key'])) {
            Session::flash('alert-error', trans('baseTexts.keyCannotBeEmpty'));
            return redirect('vigenereCipher');
        }
        if (!is_string($data['text']) || empty($data['text'])) {
            Session::flash('alert-error', trans('baseTexts.textCannotBeEmpty'));
            return redirect('vigenereCipher');
        }
        if ($data['action'] === null) {
            Session::flash('alert-error', trans('baseTexts.actionCannotBeEmpty'));
            return redirect('vigenereCipher');
        }

        $vigenere = new Vigenere($data['text'], $data['key'], $data['action']);

        $result = match ($vigenere->getOperation()) {
            CipherBase::ALGORITHM_DECRYPT => $vigenere->decrypt(),
            CipherBase::ALGORITHM_ENCRYPT => $vigenere->encrypt(),
        };

        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash('alert-info', trans('baseTexts.actionTook') . ' ' . $time_elapsed_secs . ' s');
        Session::flash('data', $data);
        Session::flash('result', $result);
        return redirect('vigenereCipher');
    }


}
