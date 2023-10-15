<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;

class BaseController extends Controller
{
    const TYPE_TEXT = 0,
        TYPE_NUMBER = 1,
        TYPE_NONZERO_NUMBER = 2;
    const VALIDATION_EMPTY = 'empty', VALIDATION_NOT_BINARY = 'notBinary';
    public array $validationFailedVariable;

    protected function isBinary(string $text, string $inputVariable): bool
    {
        foreach(str_split($text,1) as $char){
            if($char !== '0' && $char !== '1'){
                $this->validationFailedVariable[self::VALIDATION_NOT_BINARY] = $inputVariable;
            }
        }
        return true;
    }

    protected function basicValidate(array $data)
    {
        $this->isVariableSet($data['text'], self::TYPE_TEXT, trans('baseTexts.text'));
        $this->isVariableSet($data['key'], self::TYPE_TEXT, trans('baseTexts.key'));
        $this->isVariableSet($data['action'], self::TYPE_NUMBER, trans('baseTexts.action'));
    }

    protected function isVariableSet(string|int|null $variable, int $type, string $variableName): void
    {
        $validationFailed = false;
        if ($type === self::TYPE_TEXT) {
            if (!is_string($variable) || empty($variable)) {
                $validationFailed = true;
            }
        } elseif ($type === self::TYPE_NONZERO_NUMBER) {
            if (!is_numeric($variable) || empty($variable)) {
                $validationFailed = true;
            }
        } elseif ($type === self::TYPE_NUMBER) {
            if (!is_numeric($variable)) {
                $validationFailed = true;
            }
        }
        if ($validationFailed) {
            $this->validationFailedVariable[self::VALIDATION_EMPTY] = $variableName;
        }
    }

    protected function getValidationErrorTranslation()
    {
        $validationTexts = '';
        $emptyValues = [];
        $notBinary = [];
        foreach ($this->validationFailedVariable as $key => $failedValidation){
            switch ($key) {
                case self::VALIDATION_EMPTY: $emptyValues[] = $failedValidation;
                break;
                case self::VALIDATION_NOT_BINARY: $notBinary[] = $failedValidation;
                break;
            }
        }
        if(!empty($emptyValues)) {
            $validationTexts .= trans('baseTexts.cannotBeEmpty', implode(', ', $emptyValues));
        }
        if(!empty($notBinary)){
            $validationTexts .= trans('baseTexts.notBinary', implode(', ', $notBinary));
        }
        return $validationTexts;
    }

    protected function hextobin($hexstr)
    {
        $n = strlen($hexstr);
        $sbin = '';
        $i = 0;
        while ($i < $n) {
            $a = substr($hexstr, $i, 2);
            $c = pack('H*', $a);
            if ($i == 0) {
                $sbin = $c;
            } else {
                $sbin .= $c;
            }
            $i += 2;
        }
        return $sbin;
    }
}