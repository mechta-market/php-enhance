<?php

namespace MechtaMarket\PhpEnhance;

class Error
{
    public function __construct(private readonly string $message, private readonly \Throwable|null $object = null) {}

    public function getMessage(): string {
        return $this->message;
    }

    public function getObject(): \Throwable|null {
        return $this->object;
    }
}
