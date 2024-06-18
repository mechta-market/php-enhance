<?php

namespace MechtaMarket\PhpEnhance\Traits;

trait Errors
{
    private array $errors = [];

    /**
     * @return string[]
     */
    public function getErrorsMessages(): array
    {
        $errors = [];
        foreach($this->errors as $error){
            $errors[] = $error['msg'];
        }
        return $errors;
    }

    public function hasErrors(): bool
    {
        return ! empty($this->errors);
    }

    /**
     * @return array{msg: string, context: array}
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function addError(string $error, $context = []): void
    {
        $this->errors[] = [
            "msg" => $error,
            "context" => $context,
        ];
    }
}
