<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RsaController extends BaseController
{
    function index()
    {
        if (Session::exists('data')) {
            return view('asymmetricCiphers/rsaCipher')->with(['data' => Session::get('data')]);
        }

        //Session::flash('alert-warning', trans('baseTexts.notReady'));
        //return redirect()->back();

        return view('asymmetricCiphers/rsaCipher');
    }

    function compute(Request $request)
    {
        $timerStart = microtime(true);
        $data = $request->all();

        $this->basicValidate($data);
        $this->isVariableSet($data['primeNumber1'], self::TYPE_NONZERO_NUMBER, trans('baseTexts.primeNumber'));
        $this->isVariableSet($data['primeNumber2'], self::TYPE_NONZERO_NUMBER, trans('baseTexts.primeNumber'));

        if (!empty($this->validationFailedVariable)) {
            Session::flash('alert-error', $this->getValidationErrorTranslation());
            return back()->withInput($data);
        }

        $firstInputNumber = $data['primeNumber1'];
        $secondInputNumber = $data['primeNumber2'];

        //Error if number is not prime number
        if (!$this->isPrimeNumber($firstInputNumber)) {
            return redirect()->back()->with('alert-error', trans('rsaPageTexts.firstNumberNotPrime'));
        }
        if (!$this->isPrimeNumber($secondInputNumber)) {
            return redirect()->back()->with('alert-error', trans('rsaPageTexts.secondNumberNotPrime'));
        }

        //TODO finish this -> use new Encryption class - this code is deprecated

        if ($data['action'] == 'encrypt') {
            //$data['finalText'] = base64_encode($bf->b_encrypt($data['text']));
        } else {
            //$data['finalText'] = $bf->b_decrypt(base64_decode($data['text']));
        }


        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash('alert-info', trans('baseTexts.actionTook') . ' ' . $time_elapsed_secs . ' s');
        Session::flash('data', $data);
        return redirect('rsaCipher');
    }

    function isPrimeNumber($number): bool
    {
        if ($number <= 1) {
            return false;
        }

        $sqrt = floor(sqrt($number));
        for ($i = 2; $i <= $sqrt; $i++) {
            if ($number % $i == 0) {
                return false;
            }
        }
        return true;
    }
}
