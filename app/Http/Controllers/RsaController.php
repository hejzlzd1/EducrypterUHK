<?php

namespace App\Http\Controllers;

use App\Algorithms\CipherBase;
use App\Algorithms\Ciphers\Rsa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RsaController extends BaseController
{
    function index()
    {
        if (Session::exists('result')) {
            return view('asymmetricCiphers/RsaCipher')->with(
                ['result' => Session::get('result'), 'data' => Session::get('data')]
            );
        }

        return view('asymmetricCiphers/rsaCipher');
    }

    function compute(Request $request)
    {
        $timerStart = microtime(true);
        $data = $request->all();

        $this->isVariableSet($data['text'], self::TYPE_TEXT, trans('baseTexts.text'));
        $this->isVariableSet($data['action'], self::TYPE_NUMBER, trans('baseTexts.action'));
        $this->isVariableSet((int)$data['primeNumber1'], self::TYPE_NONZERO_NUMBER, trans('baseTexts.primeNumber') . ' #1');
        $this->isVariableSet((int)$data['primeNumber2'], self::TYPE_NONZERO_NUMBER, trans('baseTexts.primeNumber') . ' #2');
        $firstInputNumber = $data['primeNumber1'];
        $secondInputNumber = $data['primeNumber2'];
        $this->isPrimeNumber($firstInputNumber, trans('baseTexts.primeNumber') . ' #1');
        $this->isPrimeNumber($secondInputNumber, trans('baseTexts.primeNumber') . ' #2');

        if (!empty($this->validationFailedVariable)) {
            Session::flash('alert-error', $this->getValidationErrorTranslation());
            return back()->withInput($data);
        }

        try {
            $rsa = new Rsa($data['text'], null, $data['action'], $firstInputNumber, $secondInputNumber);
        } catch (\Exception $e) {
            Session::flash('alert-error', $e->getMessage());
            return back();
        }

        $result = match ($rsa->getOperation()) {
            CipherBase::ALGORITHM_DECRYPT => $rsa->decrypt(),
            CipherBase::ALGORITHM_ENCRYPT => $rsa->encrypt()
        };

        dd($result);

        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash('alert-info', trans('baseTexts.actionTook') . ' ' . $time_elapsed_secs . ' s');
        Session::flash('data', $data);
        return redirect('rsaCipher');
    }
}
