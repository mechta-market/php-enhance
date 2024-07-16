<?php

namespace MechtaMarket\PhpEnhance;

class OutputError
{
    public function __construct(private readonly string $message, private readonly int $statusCode = 500) {}

    public function getMessage(): string {
        return $this->message;
    }

    public function getStatusCode(): int {
        return $this->statusCode;
    }
}