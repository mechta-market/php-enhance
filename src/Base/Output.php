<?php

namespace MechtaMarket\PhpEnhance\Base;

use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;

final class Output
{
    private bool $result = false;
    private array $errors = [];
    protected ?int $code = null;
    protected UsecaseDataInterface $usecaseData;

    public function isSuccess(): bool
    {
        return $this->result;
    }

    public function isFailed(): bool
    {
        return ! $this->isSuccess();
    }

    public function setResult(bool $result): bool
    {
        return $this->result = $result;
    }

    public function getResult(): bool
    {
        return $this->result;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getArrayResponse(): array
    {
        return [
            'result' => $this->getResult(),
            'errors' => $this->getErrors(),
            'code' => $this->getCode(),
            'data' => $this->usecaseData->getData()
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