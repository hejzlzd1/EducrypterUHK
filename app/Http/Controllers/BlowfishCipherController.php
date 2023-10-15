<?php

namespace App\Http\Controllers;

use App\Algorithms\CipherBase;
use App\Algorithms\Ciphers\Blowfish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BlowfishCipherController extends BaseController
{
    function index()
    {
        if (Session::exists('data')) {
            return view('symmetricCiphers/blowfishCipher')->with(
                ['data' => Session::get('data'), 'result' => Session::get('result')]
            );
        }
        return view('symmetricCiphers/blowfishCipher');
    }

    function compute(Request $request)
    {
        $timerStart = microtime(true);
        $data = $request->all();
        $this->basicValidate($data);

        if(!empty($this->validationFailedVariable)){
            Session::flash('alert-error', $this->getValidationErrorTranslation());
            return back()->withInput($data);
        }

        try {
            $blowfish = new Blowfish($data['text'], $data['key'], $data['action']);
        } catch (\Exception $e) {
            Session::flash('alert-error', $e->getMessage());
            return redirect('blowfishCipher');
        }

        $result = match ($blowfish->getOperation()) {
            CipherBase::ALGORITHM_DECRYPT => $blowfish->decrypt(),
            CipherBase::ALGORITHM_ENCRYPT => $blowfish->encrypt()
        };

        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash('alert-info', trans('baseTexts.actionTook') . ' ' . $time_elapsed_secs . ' s');
        Session::flash('data', $data);
        Session::flash('result', $result);
        return redirect('blowfishCipher');
    }

}
