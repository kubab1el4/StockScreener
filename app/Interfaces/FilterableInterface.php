<?php

namespace App\Interfaces;

interface FilterableInterface {
    public function getKeys(): array;

    public function setKeys(array $keys): void;

    public function filter(int $limit, string $function, string $operator, float $value): FilterableInterface;


}
