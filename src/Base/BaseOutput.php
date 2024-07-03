<?php

namespace MechtaMarket\PhpEnhance\Base;

use MechtaMarket\PhpEnhance\Collections\ErrorCollection;
use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;

final class BaseOutput
{
    private ErrorCollection $errors;
    protected ?int $code = null;
    protected UsecaseDataInterface $usecaseData;

    public function isSuccess(): bool
    {
        return $this->getResult();
    }

    public function isFailed(): bool
    {
        return ! $this->isSuccess();
    }

    public function getResult(): bool
    {
        return $this->getCode() === 200;
    }

    public function getErrors(): ErrorCollection
    {
        return $this->errors;
    }

    public function setErrors(ErrorCollection $errors): void
    {
        $this->errors = $errors;
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function getCode(): int
    {
        return $this->getErrors()->isEmpty() ? 200 : $this->getErrors()->first()->getCode();
    }

    public function getArrayResponse(): array
    {
        return [
            'result' => $this->getResult(),
            'errors' => $this->getErrors()->getMessages(),
            'code' => $this->getCode(),
            'data' => $this->isSuccess() ? $this->usecaseData->getData() : null,
        ];
    }

    public function getJsonResponse(): string
    {
        return json_encode($this->getArrayResponse());
    }

    public function setUsecaseData(UsecaseDataInterface $usecaseData): void
    {
        $this->usecaseData = $usecaseData;
    }
}
