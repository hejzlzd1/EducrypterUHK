<?php

namespace App\Http\Controllers;

use App\Algorithms\CipherBase;
use App\Algorithms\Ciphers\DiffieHellman;
use App\Algorithms\Ciphers\Rsa;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class DiffieHellmanCipherController extends BaseController
{
    public function index(): Factory|View|Application
    {
        if (Session::exists('result')) {
            return view('asymmetricCiphers/diffieHellmanCipher')->with(
                ['result' => Session::get('result'), 'data' => Session::get('data')]
            );
        }

        return view('asymmetricCiphers/diffieHellmanCipher');
    }

    public function compute(Request $request): Redirector|Application|RedirectResponse
    {
        $timerStart = microtime(true);
        $data = $request->all();

        $this->isVariableSet($data['base'], self::TYPE_NONZERO_NUMBER, trans('diffieHellmanPageTexts.base'));
        $this->isVariableSet($data['modulus'], self::TYPE_NONZERO_NUMBER, trans('diffieHellmanPageTexts.modulus'));
        $this->isVariableSet($data['keyA'], self::TYPE_NONZERO_NUMBER, trans('diffieHellmanPageTexts.keyA'));
        $this->isVariableSet($data['keyB'], self::TYPE_NONZERO_NUMBER, trans('diffieHellmanPageTexts.keyB'));

        if (!empty($this->validationFailedVariable)) {
            Session::flash('alert-error', $this->getValidationErrorTranslation());
            return back()->withInput($data);
        }

        $diffieHellman = new DiffieHellman(
            modulus: $data['modulus'],
            base: $data['base'],
            a: $data['keyA'],
            b: $data['keyB'],
        );

        $result = $diffieHellman->generateSecret();

        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash('alert-info', trans('baseTexts.actionTook') . ' ' . $time_elapsed_secs . ' s');
        Session::flash('data', $data);
        Session::flash('result', $result);

        return redirect('diffieHellmanCipher');
    }
}
