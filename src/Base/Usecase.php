<?php

namespace MechtaMarket\PhpEnhance\Base;

use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;
use MechtaMarket\PhpEnhance\Traits\Errors;

abstract class Usecase
{
    use Errors;
    private Output $output;
    private Input $input;
    private UsecaseDataInterface $data;

    public function __construct(){
        $this->output = new Output();
        $this->setData();
    }

    final public function getOutput(): Output {
        $this->output->setErrors($this->getErrorsMessages());

        $this->setDataInOutput();

        return $this->output;
    }

    private function setDataInOutput(): void {
        $this->output->setUsecaseData($this->data);
    }

    final public function setInput(Input $input): void {
        $this->input = $input;
    }

    abstract public function execute(): void;

    private function setData(): void
    {
        $this->data = new UsecaseData();
    }
}