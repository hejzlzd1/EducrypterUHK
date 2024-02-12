<?php

namespace App\Http\Controllers;

use App\Algorithms\CipherBase;
use App\Algorithms\Ciphers\Rsa;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class RsaCipherController extends BaseController
{
    public function index(): Factory|View|Application
    {
        if (Session::exists('result')) {
            return view('asymmetricCiphers/rsaCipher')->with(
                ['result' => Session::get('result'), 'data' => Session::get('data')]
            );
        }

        return view('asymmetricCiphers/rsaCipher');
    }

    public function compute(Request $request): Redirector|Application|RedirectResponse
    {
        $timerStart = microtime(true);
        $data = $request->all();

        $this->isVariableSet($data['text'], self::TYPE_TEXT, trans('baseTexts.text'));
        $this->isVariableSet($data['action'], self::TYPE_NUMBER, trans('baseTexts.action'));
        if ($data['action'] == CipherBase::ALGORITHM_DECRYPT) {
            $this->isVariableSet($data['publicKey'], self::TYPE_NONZERO_NUMBER, trans('baseTexts.publicKey'));
            $this->isVariableSet($data['privateKey'], self::TYPE_NONZERO_NUMBER, trans('baseTexts.privateKey'));
        } else {
            $this->isVariableSet((int) $data['primeNumber1'], self::TYPE_NONZERO_NUMBER, trans('baseTexts.primeNumber').' #1');
            $this->isVariableSet((int) $data['primeNumber2'], self::TYPE_NONZERO_NUMBER, trans('baseTexts.primeNumber').' #2');
            $firstInputNumber = $data['primeNumber1'];
            $secondInputNumber = $data['primeNumber2'];
            if ($firstInputNumber * $secondInputNumber < 256) {
                $this->validationFailedVariable[BaseController::VALIDATION_CUSTOM_MESSAGE] = trans('rsaPageTexts.primeNumbersAreLow');
            }
            $this->isPrimeNumber($firstInputNumber, trans('baseTexts.primeNumber').' #1');
            $this->isPrimeNumber($secondInputNumber, trans('baseTexts.primeNumber').' #2');
        }

        if (!empty($this->validationFailedVariable)) {
            Session::flash('alert-error', $this->getValidationErrorTranslation());
            return back()->withInput($data);
        }

        $rsa = new Rsa($data['text'], $data['publicKey'] ?? null, $data['privateKey'] ?? null, $data['action'], $firstInputNumber ?? null, $secondInputNumber ?? null);

        $result = match ($rsa->getOperation()) {
            CipherBase::ALGORITHM_DECRYPT => $rsa->decrypt(),
            CipherBase::ALGORITHM_ENCRYPT => $rsa->encrypt()
        };

        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash('alert-info', trans('baseTexts.actionTook').' '.$time_elapsed_secs.' s');
        Session::flash('data', $data);
        Session::flash('result', $result);

        return redirect('rsaCipher');
    }
}
