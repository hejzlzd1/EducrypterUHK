<?php

namespace App\Algorithms\Output\Steps;

class NamedStep extends Step
{
    public function __construct(string $input, string $output = '', private string $translatedActionName = '')
    {
        $this->setOutput($output);
        parent::__construct($input);
    }

    /**
     * @param string $translatedActionName
     */
    public function setTranslatedActionName(string $translatedActionName): void
    {
        $this->translatedActionName = $translatedActionName;
    }

    /**
     * @return string
     */
    public function getTranslatedActionName(): string
    {
        return $this->translatedActionName;
    }
}
