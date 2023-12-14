<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    const TYPE_TEXT = 0,
        TYPE_NUMBER = 1,
        TYPE_NONZERO_NUMBER = 2;
    const VALIDATION_EMPTY = 'empty', VALIDATION_NOT_BINARY = 'notBinary', VALIDATION_NOT_PRIME_NUMBER = 'notPrimeNumber';

    public array $validationFailedVariable;
    private bool $validationFailed = false;

    protected function isBinary(string $text, string $inputVariable): bool
    {
        if (preg_match('/^[01]+$/', $text) !== 1) {
            $this->validationFailedVariable[self::VALIDATION_NOT_BINARY] = $inputVariable;
            return false;
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
        if(!isset($variable)) {
            $this->validationFailedVariable[self::VALIDATION_EMPTY] = $variableName;
            return;
        }
        if ($type === self::TYPE_TEXT) {
            if (!is_string($variable) || empty($variable)) {
                $this->validationFailedVariable[self::VALIDATION_EMPTY] = $variableName;
            }
        } elseif ($type === self::TYPE_NONZERO_NUMBER) {
            if (!is_numeric($variable) || empty($variable)) {
                $this->validationFailedVariable[self::VALIDATION_EMPTY] = $variableName;
            }
        } elseif ($type === self::TYPE_NUMBER) {
            if (!is_numeric($variable)) {
                $this->validationFailedVariable[self::VALIDATION_EMPTY] = $variableName;
            }
        }
    }

    protected function isPrimeNumber(int $number,string $variableName): bool
    {
        if ($number <= 1) {
            $this->validationFailedVariable[self::VALIDATION_NOT_PRIME_NUMBER] = $variableName;
            return false;
        }

        $sqrt = floor(sqrt($number));
        for ($i = 2; $i <= $sqrt; $i++) {
            if ($number % $i == 0) {
                $this->validationFailedVariable[self::VALIDATION_NOT_PRIME_NUMBER] = $variableName;
                return false;
            }
        }

        return true;
    }

    protected function getValidationErrorTranslation(): string
    {
        $validationTexts = [];
        foreach ($this->validationFailedVariable as $key => $failedValidation) {
            switch ($key) {
                case self::VALIDATION_EMPTY:
                    $validationTexts[] = trans('baseTexts.cannotBeEmpty', ['variableName' => $failedValidation]);
                    break;
                case self::VALIDATION_NOT_BINARY:
                    $validationTexts[] = trans('baseTexts.notBinary', ['variableName' => $failedValidation]);
                    break;
                case self::VALIDATION_NOT_PRIME_NUMBER:
                    $validationTexts[] = trans('baseTexts.notPrime', ['variableName' => $failedValidation]);
                    break;
            }
        }

        return implode(" \n", $validationTexts);
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