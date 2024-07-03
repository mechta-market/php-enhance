<?php

namespace MechtaMarket\PhpEnhance\Collections;

use MechtaMarket\PhpEnhance\Error;
use MechtaMarket\PhpEnhance\Collections\Collection;

class ErrorCollection extends Collection
{
    public function addError(string $error, $code = 500): void
    {
        $this->append(new Error($error, $code));
    }

    public function getMessages(): array
    {
        $errors = [];
        /** @var Error $error */
        foreach($this->items as $error){
            $errors[] = $error->getMessage();
        }

        return $errors;
    }
}
