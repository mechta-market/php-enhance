<?php

namespace MechtaMarket\PhpEnhance\Base;

use MechtaMarket\PhpEnhance\Interfaces\OutputFormatInterface;

final class Output
{
    private bool $result = false;
    private array $errors = [];
    protected OutputFormatInterface $format;

    public function isSuccess(): bool
    {
        return $this->result;
    }

    public function isFailed(): bool
    {
        return ! $this->isSuccess();
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }

    public function getArrayResponse(): array
    {
        return [
            'result' => $this->result,
            'errors' => $this->errors,
            'data' => $this->format->getData()
        ];
    }

    public function getJsonResponse(): string
    {
        return json_encode($this->getArrayResponse());
    }

    public function setFormat(OutputFormatInterface $format): void
    {
        $this->format = $format;
    }
}