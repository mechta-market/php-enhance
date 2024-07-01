<?php

namespace MechtaMarket\PhpEnhance\Base;

use MechtaMarket\PhpEnhance\Interfaces\OutputFormatInterface;
use MechtaMarket\PhpEnhance\Traits\Errors;

abstract class Usecase
{
    use Errors;
    private Output $output;
    private Input $input;

    public function __construct(){
        $this->output = new Output();
    }

    final public function getOutput(): Output {
        $this->output->setErrors($this->getErrorsMessages());

        $this->setFormatInOutput();

        return $this->output;
    }

    private function setFormatInOutput(): void {
        $format = new class implements OutputFormatInterface{
            public function getData(): array
            {
                return [];
            }
        };

        $this->output->setFormat($format);
    }

    final public function setInput(Input $input): void {
        $this->input = $input;
    }

    abstract public function execute(): void;
}