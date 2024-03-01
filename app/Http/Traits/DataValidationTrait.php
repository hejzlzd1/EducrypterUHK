<?php

namespace App\Http\Traits;

use App\Http\Controllers\BaseController;

trait DataValidationTrait
{
    public array $validationFailedVariable;

    protected function isBinary(?string $text, string $variableName): void
    {
        if ($text === null) {
            $this->validationFailedVariable[BaseController::VALIDATION_EMPTY] = $variableName;
            return;
        }
        if (preg_match('/^[01]+$/', $text) !== 1) {
            $this->validationFailedVariable[BaseController::VALIDATION_NOT_BINARY] = $variableName;
        }
    }

    protected function basicValidate(array $data): void
    {
        $this->isVariableSet($data['text'], BaseController::TYPE_TEXT, trans('baseTexts.text'));
        $this->isVariableSet($data['key'], BaseController::TYPE_TEXT, trans('baseTexts.key'));
        $this->isVariableSet($data['action'], BaseController::TYPE_NUMBER, trans('baseTexts.action'));
    }

    protected function isVariableSet(string|int|null $variable, int $type, string $variableName): void
    {
        if (!isset($variable)) {
            $this->validationFailedVariable[BaseController::VALIDATION_EMPTY] = $variableName;
            return;
        }
        if ($type === BaseController::TYPE_TEXT) {
            if (!is_string($variable) || empty($variable)) {
                $this->validationFailedVariable[BaseController::VALIDATION_EMPTY] = $variableName;
            }
        } elseif ($type === BaseController::TYPE_NONZERO_NUMBER) {
            if (!is_numeric($variable) || empty($variable)) {
                $this->validationFailedVariable[BaseController::VALIDATION_EMPTY] = $variableName;
            }
        } elseif ($type === BaseController::TYPE_NUMBER) {
            if (!is_numeric($variable)) {
                $this->validationFailedVariable[BaseController::VALIDATION_EMPTY] = $variableName;
            }
        }
    }

    protected function isPrimeNumber(int $number, string $variableName): void
    {
        if ($number <= 1) {
            $this->validationFailedVariable[BaseController::VALIDATION_NOT_PRIME_NUMBER] = $variableName;
            return;
        }

        $sqrt = floor(sqrt($number));
        for ($i = 2; $i <= $sqrt; $i++) {
            if ($number % $i == 0) {
                $this->validationFailedVariable[BaseController::VALIDATION_NOT_PRIME_NUMBER] = $variableName;
                return;
            }
        }
    }

    protected function getValidationErrorTranslation(): string
    {
        $validationTexts = [];
        foreach ($this->validationFailedVariable as $key => $failedValidation) {
            switch ($key) {
                case BaseController::VALIDATION_EMPTY:
                    $validationTexts[] = (string) trans('baseTexts.cannotBeEmpty', ['variableName' => $failedValidation]);
                    break;
                case BaseController::VALIDATION_NOT_BINARY:
                    $validationTexts[] = (string) trans('baseTexts.notBinary', ['variableName' => $failedValidation]);
                    break;
                case BaseController::VALIDATION_NOT_PRIME_NUMBER:
                    $validationTexts[] = (string) trans('baseTexts.notPrime', ['variableName' => $failedValidation]);
                    break;
                case BaseController::VALIDATION_CUSTOM_MESSAGE:
                    // Adds custom message validation -> allows to add custom errors from controller
                    $validationTexts[] = $failedValidation;
                    break;
            }
        }

        return implode(" \n", $validationTexts);
    }
}
