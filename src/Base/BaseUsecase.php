<?php

namespace MechtaMarket\PhpEnhance\Base;

use MechtaMarket\PhpEnhance\Collections\ErrorCollection;
use MechtaMarket\PhpEnhance\Collections\OutputErrorCollection;
use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;

abstract class BaseUsecase
{
    private BaseOutput $output;
    protected BaseInput $input;
    protected UsecaseDataInterface $data;
    protected OutputErrorCollection $errors;

    public function __construct(){
        $this->output = new BaseOutput();
        $this->errors = new OutputErrorCollection();
        $this->setData();
    }

    final public function getOutput(): BaseOutput {
        $this->output->setErrors($this->errors);

        $this->setDataInOutput();

        return $this->output;
    }

    private function setDataInOutput(): void {
        $this->output->setUsecaseData($this->data);
    }

    final public function setInput(BaseInput $input): void {
        $this->input = $input;
    }

    final public function getInput(): BaseInput {
        return $this->input;
    }

    abstract public function execute(): void;

    abstract protected function setData(): void;
}
