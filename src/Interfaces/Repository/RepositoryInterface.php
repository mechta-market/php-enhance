<?php
namespace MechtaMarket\PhpEnhance\Interfaces\Repository;

interface RepositoryInterface
{
    public function create(mixed $entity): mixed;

    public function find(array $where = [], array $columns = ['*'], array $relations = [], array $orders = [],
        int $limit = 0): mixed;

    public function update(mixed $entity): mixed;

    public function delete(mixed $entity): mixed;
}