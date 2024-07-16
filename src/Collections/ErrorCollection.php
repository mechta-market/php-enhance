<?php

namespace MechtaMarket\PhpEnhance\Collections;

use MechtaMarket\PhpEnhance\Error;
use MechtaMarket\PhpEnhance\Collections\Collection;

/** @property Error[] $items */
class ErrorCollection extends Collection
{
    public function addError(string $error, \Throwable|null $object = null): void
    {
        $this->append(new Error($error, $object));
    }

    public function getMessages(): array
    {
        $errors = [];
        foreach($this->items as $error){
            $errors[] = $error->getMessage();
        }

        return $errors;
    }
}
