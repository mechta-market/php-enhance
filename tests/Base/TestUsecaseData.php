<?php

namespace Tests\Base;

use MechtaMarket\PhpEnhance\Interfaces\UsecaseDataInterface;

class TestUsecaseData implements UsecaseDataInterface
{
    public function getData(): array
    {
        return [
            "id" =>"id",
            "name" => "name",
            "code" => "code",
            "price" => "price",
        ];
    }
}