<?php

namespace MechtaMarket\PhpEnhance\Base;

use MechtaMarket\PhpEnhance\Collections\OutputErrorCollection;
use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;

final class BaseOutput
{
    private OutputErrorCollection $errors;
    protected ?int $statusCode = null;
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
        return $this->getStatusCode() === 200;
    }

    public function getErrors(): OutputErrorCollection
    {
        return $this->errors;
    }

    public function setErrors(OutputErrorCollection $errors): void
    {
        $this->errors = $errors;
    }

    public function getStatusCode(): int
    {
        return $this->getErrors()->isEmpty() ? 200 : $this->getErrors()->first()->getStatusCode();
    }

    public function getArrayResponse(): array
    {
        return [
            'result' => $this->getResult(),
            'errors' => $this->getErrors()->getMessages(),
            'code' => $this->getStatusCode(),
            'data' => $this->isSuccess() ? $this->usecaseData->getData() : null,
        ];
    }

    public function setUsecaseData(UsecaseDataInterface $usecaseData): void
    {
        $this->usecaseData = $usecaseData;
    }
}
