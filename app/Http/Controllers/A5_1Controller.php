<?php

namespace App\Http\Controllers;

use App\Algorithms\CipherBase;
use App\Algorithms\Ciphers\A5_1;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class A5_1Controller extends Controller
{
    function index()
    {
        if (Session::exists('data')) {
            return view('streamCiphers/a51Cipher')->with(
                ['data' => Session::get('data'), 'result' => Session::get('result')]
            );
        }
        return view('streamCiphers/a51Cipher');
    }

    function compute(Request $request)
    {
        $timerStart = microtime(true);
        $data = $request->all();
        if (!is_string($data['key']) || empty($data['key'])) {
            Session::flash('alert-error', trans('baseTexts.keyCannotBeEmpty'));
            return back()->withInput();
        }
        if (!is_string($data['text']) || empty($data['text'])) {
            Session::flash('alert-error', trans('baseTexts.textCannotBeEmpty'));
            return back()->withInput();
        }
        if ($data['action'] === null) {
            Session::flash('alert-error', trans('baseTexts.actionCannotBeEmpty'));
            return back()->withInput();
        }
        if (!is_string($data['iv']) || empty($data['iv'])) {
            Session::flash('alert-error', trans('baseTexts.ivCannotBeEmpty'));
            return back()->withInput();
        }

        try {
            $a51 = new A5_1($data['text'], $data['key'], $data['action'], $data['iv']);
        } catch (\Exception $e) {
            Session::flash('alert-error', $e->getMessage());
            return back();
        }

        $result = match ($a51->getOperation()) {
            CipherBase::ALGORITHM_DECRYPT => $a51->decrypt(),
            CipherBase::ALGORITHM_ENCRYPT => $a51->encrypt()
        };

        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash('alert-info', trans('baseTexts.actionTook') . ' ' . $time_elapsed_secs . ' s');
        Session::flash('data', $data);
        Session::flash('result', $result);
        return back();
    }
}
