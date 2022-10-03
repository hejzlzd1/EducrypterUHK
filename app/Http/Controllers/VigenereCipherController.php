<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class VigenereCipherController extends BaseController
{
    public function index()
    {
        return view("vigenereCipher");
    }

    public function compute(Request $request)
    {
        $timerStart = microtime(true);
        $data = $request->all();

        $data["action"] == "encrypt" ? $encrypt = true : $encrypt = false;
        $data["finalText"] = $this->vigenere($this->normalize($data["text"]),$data["key"],$encrypt);

        $time_elapsed_secs = microtime(true) - $timerStart;
        Session::flash("alert-info",trans("baseTexts.actionTook") . " ".$time_elapsed_secs . " s");
        return View::make('vigenereCipher')->with('data', $data);
    }

    function normalize($string): string
    {
        $table = array(
            'Š' => 'S', 'š' => 's', 'Đ' => 'Dj', 'đ' => 'dj', 'Ž' => 'Z', 'ž' => 'z', 'Č' => 'C', 'č' => 'c', 'Ć' => 'C', 'ć' => 'c',
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O',
            'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
            'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o',
            'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ě' => 'e', 'þ' => 'b',
            'ÿ' => 'y', 'Ŕ' => 'R', 'ŕ' => 'r',
        );

        return strtr($string, $table);
    }


    function Mod($a, $b)
    {
        return ($a % $b + $b) % $b;
    }

    /**
     * @param $input
     * @param $key
     * @param $encipher
     * Values:
     * Decrypt = false
     * Encrypt = true
     * @return string
     */
    function vigenere($input, $key, $encipher)
    {
        $keyLen = strlen($key);

        for ($i = 0; $i < $keyLen; ++$i)
            if (!ctype_alpha($key[$i]))
                return ""; // Error

        $output = "";
        $nonAlphaCharCount = 0;
        $inputLen = strlen($input);

        for ($i = 0; $i < $inputLen; ++$i)
        {
            if (ctype_alpha($input[$i]))
            {
                $cIsUpper = ctype_upper($input[$i]);
                $offset = ord($cIsUpper ? 'A' : 'a');
                $keyIndex = ($i - $nonAlphaCharCount) % $keyLen;
                $k = ord($cIsUpper ? strtoupper($key[$keyIndex]) : strtolower($key[$keyIndex])) - $offset;
                $k = $encipher ? $k : -$k;
                $ch = chr(($this->mod(((ord($input[$i]) + $k) - $offset), 26)) + $offset);
                $output .= $ch;
            }
            else
            {
                $output .= $input[$i];
                ++$nonAlphaCharCount;
            }
        }

        return $output;
    }
}
