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

        if (!empty($this->validationFailedVariable)) {
            Session::flash('alert-error', $this->getValidationErrorTranslation());

            return back()->withInput($data);
        }

        $simpleDes = new SimpleDes($data['text'], $data['key'], $data['action']);

        /**
         * Improvement idea:
         * Instead of repeating this four-liner, there could be helper class that does same thing but uses abstract class.
         * This solution would make one-line function - removing boilerplate.
         * @see BaseCipher
        */
        $result = match ($simpleDes->getOperation()) {
            CipherBase::ALGORITHM_DECRYPT => $simpleDes->decrypt(),
            CipherBase::ALGORITHM_ENCRYPT => $simpleDes->encrypt()
        };

        // This could be also improved by some static helper class
        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash('alert-info', trans('baseTexts.actionTook') . ' ' . $time_elapsed_secs . ' s');
        Session::flash('data', $data);
        Session::flash('result', $result);

        return redirect()->back()->withFragment('renderedResult');
    }
}
