<?php

namespace MechtaMarket\PhpEnhance\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use MechtaMarket\PhpEnhance\Interfaces\Repository\RepositoryInterface;

abstract class BaseEloquentRepository implements RepositoryInterface
{
    protected Model $model;

    public function find(array $where = [], array $columns = ['*'], array $relations = [], array $orders = [],
        int $limit = 0,
    ): mixed {
        $query = $this->model->with($relations);
        if (!empty($where)) {
            $this->applyFilters($query, $where);
        }
        if (! empty($relations)) {
            $query->with($relations);
        }
        if ($limit > 0) {
            $query->limit($limit);
        }
        if (! empty($orders)) {
            foreach($orders as $key => $value){
                $query->orderBy($key, $value);
            }
        }

        $models = $query->get($columns);
        $items = [];
        foreach($models as $model){
            $items[] = $this->toEntity($model);
        }
        unset($models);
        return $items;
    }

    abstract protected function applyFilters(Builder $query, array $filters);

    abstract protected function toEntity(Model $model): mixed;

    abstract protected function toModel(mixed $entity): Model;

    public function create(mixed $entity): mixed
    {
        $model = $this->model->create();
        $model->fill($this->toModel($entity));
        $entity->setId($model->id);

        return true;
    }

    public function update(mixed $entity): mixed
    {
        $model = $this->model->find($entity->getId());
        $model->update($this->toModel($entity));

        return true;
    }

    public function delete(mixed $entity): mixed
    {
        return $this->model->destroy($entity->getId());
    }
}