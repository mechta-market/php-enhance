<?php

namespace MechtaMarket\PhpEnhance\Base;

use MechtaMarket\PhpEnhance\Traits\Errors;

abstract class Usecase
{
    use Errors;
    private Output $output;
    private Input $input;

    public function __construct(Input $input){
        $this->output = new Output();
        $this->input = $input;
    }

    final public function getOutput(): Output {
        $this->output->setErrors($this->getErrorsMessages());

        return $this->output;
    }

    abstract public function execute(): void;
}