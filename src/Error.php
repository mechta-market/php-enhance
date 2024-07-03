<?php

namespace MechtaMarket\PhpEnhance;

readonly class Error
{
    public function __construct(private string $message, private int $code = 500) {}

    public function getMessage(): string {
        return $this->message;
    }

    public function getCode(): int {
        return $this->code;
    }
}
