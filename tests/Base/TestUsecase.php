<?php

namespace Tests\Base;

use MechtaMarket\PhpEnhance\Base\BaseUsecase;

class TestUsecase extends BaseUsecase
{
    public bool $withClientErrors = false;

    public bool $withServerErrors = false;
    public bool $withLogger = false;

    public function execute(): void
    {
        if ($this->withClientErrors) {
            $this->errors->addClientError("Something wrong");
        }

        if ($this->withServerErrors) {
            $this->errors->addServerError("Something wrong");

            $this->logger->error("Something wrong");
        }

        if ($this->withLogger) {
            $this->logger->error("Something wrong");
        }
    }

    protected function setData(): void
    {
        $this->data = new TestUsecaseData();
    }
}