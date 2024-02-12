<?php

namespace App\Http\Controllers;

use App\Algorithms\CipherBase;
use App\Algorithms\Ciphers\Caesar;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class CaesarCipherController extends BaseController
{
    public function index(): Factory|View|Application
    {
        if (Session::exists('result')) {
            return view('symmetricCiphers/caesarCipher')->with(
                ['result' => Session::get('result'), 'data' => Session::get('data')]
            );
        }

        return view('symmetricCiphers/caesarCipher');
    }

    public function compute(Request $request): Application|RedirectResponse|Redirector
    {
        $timerStart = microtime(true);
        $data = $request->all();

        $this->isVariableSet($data['text'], self::TYPE_TEXT, trans('baseTexts.text'));
        $this->isVariableSet(
            $data['shift'] ?? 0,
            $data['action'] === CipherBase::ALGORITHM_DECRYPT_BRUTEFORCE ? self::TYPE_NONZERO_NUMBER : self::TYPE_NUMBER,
            trans('baseTexts.shift')
        );

        if (!empty($this->validationFailedVariable)) {
            Session::flash('alert-error', $this->getValidationErrorTranslation());

            return back()->withInput($data);
        }

        $caesarCipher = new Caesar(inputValue: $data['text'], shift: $data['shift'] ?? 0, operation: $data['action']);

        $result = match ($caesarCipher->getOperation()) {
            CipherBase::ALGORITHM_DECRYPT => $caesarCipher->decrypt(),
            CipherBase::ALGORITHM_ENCRYPT => $caesarCipher->encrypt(),
            CipherBase::ALGORITHM_DECRYPT_BRUTEFORCE => $caesarCipher->bruteForce(),
        };

        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash('alert-info', trans('baseTexts.actionTook') . ' ' . $time_elapsed_secs . ' s');
        Session::flash('result', $result);
        Session::flash('data', $data);

        return redirect('caesarCipher');
    }
}
