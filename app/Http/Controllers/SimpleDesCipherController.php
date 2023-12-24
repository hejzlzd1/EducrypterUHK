<?php

namespace App\Http\Controllers;

use App\Algorithms\CipherBase;
use App\Algorithms\Ciphers\SimpleDes;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class SimpleDesCipherController extends BaseController
{
    public function index(): Factory|View|Application
    {
        if (Session::exists('data')) {
            return view('symmetricCiphers/simpleDesCipher')->with(
                ['data' => Session::get('data'), 'result' => Session::get('result')]
            );
        }

        return view('symmetricCiphers/simpleDesCipher');
    }

    public function compute(Request $request): Redirector|Application|RedirectResponse
    {
        $timerStart = microtime(true);
        $data = $request->all();
        $this->isBinary($data['key'], trans('baseTexts.key'));
        $this->isBinary($data['text'], trans('baseTexts.text'));
        $this->isVariableSet($data['action'], BaseController::TYPE_NUMBER, trans('baseTexts.action'));

        if (! empty($this->validationFailedVariable)) {
            Session::flash('alert-error', $this->getValidationErrorTranslation());

            return back()->withInput($data);
        }

        try {
            $simpleDes = new SimpleDes($data['text'], $data['key'], $data['action']);
        } catch (Exception $e) {
            Session::flash('alert-error', $e->getMessage());

            return redirect('simpleDesCipher');
        }

        $result = match ($simpleDes->getOperation()) {
            CipherBase::ALGORITHM_DECRYPT => $simpleDes->decrypt(),
            CipherBase::ALGORITHM_ENCRYPT => $simpleDes->encrypt()
        };

        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash('alert-info', trans('baseTexts.actionTook').' '.$time_elapsed_secs.' s');
        Session::flash('data', $data);
        Session::flash('result', $result);

        return redirect('simpleDesCipher');
    }
}
