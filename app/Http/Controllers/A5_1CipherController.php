<?php

namespace App\Http\Controllers;

use App\Algorithms\CipherBase;
use App\Algorithms\Ciphers\A5_1;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class A5_1CipherController extends BaseController
{
    public function index(): Factory|View|Application
    {
        if (Session::exists('data')) {
            return view('streamCiphers/a51Cipher')->with(
                ['data' => Session::get('data'), 'result' => Session::get('result')]
            );
        }

        return view('streamCiphers/a51Cipher');
    }

    public function compute(Request $request): RedirectResponse
    {
        $timerStart = microtime(true);
        $data = $request->all();
        $this->basicValidate($data);
        $this->isVariableSet($data['dataFrame'], self::TYPE_NONZERO_NUMBER, trans('baseTexts.dataFrame'));
        $this->isBinary($data['key'], trans('baseTexts.key'));
        $this->isBinary($data['text'], trans('baseTexts.text'));

        if (! empty($this->validationFailedVariable)) {
            Session::flash('alert-error', $this->getValidationErrorTranslation());

            return back()->withInput($data);
        }

        try {
            $a51 = new A5_1($data['text'], $data['key'], $data['action'], $data['dataFrame']);
        } catch (Exception $e) {
            Session::flash('alert-error', $e->getMessage());

            return back();
        }

        $result = match ($a51->getOperation()) {
            CipherBase::ALGORITHM_DECRYPT => $a51->decrypt(),
            CipherBase::ALGORITHM_ENCRYPT => $a51->encrypt()
        };

        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash('alert-info', trans('baseTexts.actionTook').' '.$time_elapsed_secs.' s');
        Session::flash('data', $data);
        Session::flash('result', $result);

        return back();
    }
}
