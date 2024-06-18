<?php

namespace MechtaMarket\PhpEnhance\Base;

use MechtaMarket\PhpEnhance\Traits\Errors;

abstract class Usecase
{
    use Errors;
    private Output $output;
    private Input $input;

    public function __construct(){
        $this->output = new Output();
    }

    public function setInput(Input $input): void {
        $this->input = $input;
    }

    public function getOutput(): Output {
        $this->output->setErrors($this->getErrorsMessages());

        return $this->output;
    }

    abstract public function execute(): void;
}