<?php
namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class AesCipherController extends BaseController
{
    public function index(): Factory|View|Application
    {
        if (Session::exists('data')) return view('symmetricCiphers/aesCipher')->with(['data' => Session::get('data')]);
        return view('symmetricCiphers/aesCipher');
    }

    public function compute(Request $request): Redirector|Application|RedirectResponse
    {
        $timerStart = microtime(true);
        $data = $request->all();

        $this->basicValidate($data);

        if(!empty($this->validationFailedVariable)){
            Session::flash('alert-error', $this->getValidationErrorTranslation());
            return back()->withInput($data);
        }

        //TODO implement AES or Simple AES
        $ivText = 'LHG0xiZoQHusxqsdwadLQe';
        $iv = base64_decode($ivText);
        $bits = $data['bits'];

        $data['iv'] = $ivText;
        if ($data['action'] == 'encrypt') {
            $data['finalText'] = base64_encode(openssl_encrypt(bin2hex($data['text']), 'aes'.$bits, bin2hex($data['key']), 1, $iv));
        } else {
            $data['finalText'] = $this->hextobin(openssl_decrypt(base64_decode($data['text']), 'aes'.$bits, bin2hex($data['key']), 1, $iv));
        }

        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash('alert-info',trans('baseTexts.actionTook') . ' '.$time_elapsed_secs . ' s');
        Session::flash('data',$data);
        return redirect('aesCipher');
    }

}
