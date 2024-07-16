<?php

namespace Tests\Base;

use MechtaMarket\PhpEnhance\Base\BaseUsecase;

class TestUsecase extends BaseUsecase
{
    public bool $withErrors = false;

    public function execute(): void
    {
        if ($this->withErrors) {
            $this->errors->addClientError("Something wrong", 400);
        }
    }

    protected function setData(): void
    {
        $this->data = new TestUsecaseData();
    }
}