<?php

namespace App\Http\Controllers;

use App\Algorithms\CipherBase;
use App\Algorithms\Ciphers\Blowfish;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class BlowfishCipherController extends BaseController
{
    public function index(): Factory|View|Application
    {
        if (Session::exists('data')) {
            return view('symmetricCiphers/blowfishCipher')->with(
                ['data' => Session::get('data'), 'result' => Session::get('result')]
            );
        }

        return view('symmetricCiphers/blowfishCipher');
    }

    public function compute(Request $request): Redirector|Application|RedirectResponse
    {
        $timerStart = microtime(true);
        $data = $request->all();
        $this->basicValidate($data);

        if (!empty($this->validationFailedVariable)) {
            Session::flash('alert-error', $this->getValidationErrorTranslation());

            return back()->withInput($data);
        }

        $blowfish = new Blowfish($data['text'], $data['key'], $data['action']);

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
