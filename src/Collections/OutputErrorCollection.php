<?php

namespace MechtaMarket\PhpEnhance\Collections;

use MechtaMarket\PhpEnhance\Error;
use MechtaMarket\PhpEnhance\OutputError;

/** @property OutputError[] $items */
class OutputErrorCollection extends Collection
{
    private function addError(string $error, int $statusCode = 500): void
    {
        $this->append(new OutputError($error, $statusCode));
    }

    public function getMessages(): array
    {
        $errors = [];
        foreach($this->items as $error){
            $errors[] = $error->getMessage();
        }

        return $errors;
    }

    public function addClientError(string $error, int $statusCode = 400): void
    {
        $this->addError($error, $statusCode);
    }

    public function addServerError(string $error, int $statusCode = 500): void{
        $this->addError($error, $statusCode);
    }
}
