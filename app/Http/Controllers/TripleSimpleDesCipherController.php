<?php

namespace App\Http\Controllers;

use App\Algorithms\CipherBase;
use App\Algorithms\Ciphers\SimpleDes;
use App\Algorithms\Ciphers\TripleSimpleDes;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class TripleSimpleDesCipherController extends BaseController
{
    public function index(): Factory|View|Application
    {
        if (Session::exists('data')) {
            return view('symmetricCiphers/tripleSimpleDesCipher')->with(
                ['data' => Session::get('data'), 'result' => Session::get('result')]
            );
        }

        return view('symmetricCiphers/tripleSimpleDesCipher');
    }

    public function compute(Request $request): Redirector|Application|RedirectResponse
    {
        $timerStart = microtime(true);
        $data = $request->all();
        $this->isBinary($data['key'], trans('baseTexts.key'));
        $this->isBinary($data['key2'], trans('baseTexts.key') . ' 2');
        $this->isBinary($data['text'], trans('baseTexts.text'));
        $this->isVariableSet($data['action'], BaseController::TYPE_NUMBER, trans('baseTexts.action'));

        if (!empty($this->validationFailedVariable)) {
            Session::flash('alert-error', $this->getValidationErrorTranslation());

            return back()->withInput($data);
        }

        $tdes = new TripleSimpleDes($data['text'], $data['key'], $data['key2'], $data['action']);
        $result = match ($tdes->getOperation()) {
            CipherBase::ALGORITHM_DECRYPT => $tdes->decrypt(),
            CipherBase::ALGORITHM_ENCRYPT => $tdes->encrypt()
        };

        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash('alert-info', trans('baseTexts.actionTook') . ' ' . $time_elapsed_secs . ' s');
        Session::flash('data', $data);
        Session::flash('result', $result);

        return redirect(route('tripleSimpleDesCipherCompute'));
    }
}
