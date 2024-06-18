<?php

namespace MechtaMarket\PhpEnhance\Base;

final class Input
{
    private array $fields = [];

    public function getFields(): array{
        return $this->fields;
    }

    public function setField(string $key, mixed $value): void {
        $this->fields[$key] = $value;
    }
}