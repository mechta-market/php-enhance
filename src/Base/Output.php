<?php

namespace MechtaMarket\PhpEnhance\Base;

final class Output
{
    private bool $result = false;
    private array $errors = [];
    protected ?array $data = [];

    public function setDataField(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    public function setData($data): void
    {
        $this->data = $data;
    }

    public function isSuccess(): bool
    {
        return $this->result;
    }

    public function isFailed(): bool
    {
        return ! $this->isSuccess();
    }

    public function getData(): ?array
    {
        return $this->data;
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
            'data' => $this->getData()
        ];
    }

    public function getJsonResponse(): string
    {
        return json_encode($this->getArrayResponse());
    }
}