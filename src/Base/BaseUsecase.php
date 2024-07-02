<?php

namespace MechtaMarket\PhpEnhance\Base;

use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;
use MechtaMarket\PhpEnhance\Traits\Errors;

abstract class BaseUsecase
{
    use Errors;
    private BaseOutput $output;
    private BaseInput $input;
    private UsecaseDataInterface $data;

    public function __construct(){
        $this->output = new BaseOutput();
        $this->setData();
    }

    final public function getOutput(): BaseOutput {
        $this->output->setErrors($this->getErrorsMessages());

        $this->setDataInOutput();

        return $this->output;
    }

    private function setDataInOutput(): void {
        $this->output->setUsecaseData($this->data);
    }

    final public function setInput(BaseInput $input): void {
        $this->input = $input;
    }

    abstract public function execute(): void;

    abstract protected function setData(): void;
}