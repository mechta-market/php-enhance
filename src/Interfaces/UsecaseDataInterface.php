<?php

namespace MechtaMarket\PhpEnhance\Interfaces;

/**
 * Предназначен для хранения данных в юскейсе
 * Не храните все в одном массиве, строго запрещено
 * Для данных создавайте свойства, а getData должен собрать из них данные
 */
interface UsecaseDataInterface
{
    public function getData(): ?array;
}