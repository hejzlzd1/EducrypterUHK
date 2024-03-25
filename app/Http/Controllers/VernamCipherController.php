<?php

namespace App\Http\Controllers;

use App\Algorithms\CipherBase;
use App\Algorithms\Ciphers\Caesar;
use App\Algorithms\Ciphers\Vernam;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class VernamCipherController extends BaseController
{
    public function index(): Factory|View|Application
    {
        if (Session::exists('result')) {
            return view('symmetricCiphers/vernamCipher')->with(
                ['result' => Session::get('result'), 'data' => Session::get('data')]
            );
        }

        return view('symmetricCiphers/vernamCipher');
    }

    public function compute(Request $request): Application|RedirectResponse|Redirector
    {
        $timerStart = microtime(true);
        $data = $request->all();

        $this->basicValidate($data);
        $this->isBinary($data['key'], trans('baseTexts.key'));
        $this->isBinary($data['text'], trans('baseTexts.text'));

        if (!empty($this->validationFailedVariable)) {
            Session::flash('alert-error', $this->getValidationErrorTranslation());

            return back()->withInput($data);
        }

        $vernamCipher = new Vernam(text: $data['text'], key: $data['key'], operation: $data['action']);

        $result = match ($vernamCipher->getOperation()) {
            CipherBase::ALGORITHM_DECRYPT => $vernamCipher->decrypt(),
            CipherBase::ALGORITHM_ENCRYPT => $vernamCipher->encrypt(),
        };

        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash('alert-info', trans('baseTexts.actionTook') . ' ' . $time_elapsed_secs . ' s');
        Session::flash('result', $result);
        Session::flash('data', $data);

        return redirect()->back()->withFragment('renderedResult');
    }
}
