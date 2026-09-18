<?php

declare(strict_types=1);

namespace App\Repository;

use Illuminate\Container\Container as App;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class Repository implements RepositoryInterface
{
    /**
     * Query builder for this model
     */
    protected $modelInstance;

    /**
     * @throws RepositoryException|BindingResolutionException
     */
    public function __construct(private readonly App $app)
    {
        $this->makeModelInstance();
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract public function getModelClassName();

    public function all($columns = ['*'], $orderColumn = null, $order = null, $withRelationships = [])
    {
        $query = $this->modelInstance;

        if ($orderColumn) {
            $query = $query->orderBy($orderColumn, $order ?: 'asc');
        }

        if (count($withRelationships) > 0) {
            $query = $query->with($withRelationships);
        }

        return $query->get($columns);
    }

    public function allWhere(array $whereArray, $columns = ['*'], $orderColumn = null, $order = null, $withRelationships = []): Collection
    {
        $query = $this->modelInstance->where($whereArray);

        if ($orderColumn) {
            $query = $query->orderBy($orderColumn, $order ?: 'asc');
        }

        if (count($withRelationships) > 0) {
            $query = $query->with($withRelationships);
        }

        return $query->get($columns);
    }

    /**
     * @param  int  $perPage
     * @param  array  $columns
     *
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = ['*'])
    {
        return $this->modelInstance->orderBy('updated_at', 'desc')->paginate($perPage, $columns);
    }

    /**
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->modelInstance->create($data);
    }

    /**
     * @return mixed
     */
    public function update(array $data, $id, string $attribute = 'id')
    {
        $this->modelInstance->where($attribute, '=', $id)->update($this->onlyFillable($data));

        return $this->find($id);
    }

    /**
     * @return mixed
     */
    public function delete($id)
    {
        return $this->modelInstance->destroy($id);
    }

    /**
     * @param  array  $columns
     *
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->modelInstance->findOrFail($id, $columns);
    }

    public function updateOrCreate($criteria, $data)
    {
        return $this->modelInstance->updateOrCreate(
            $criteria,
            $data
        );
    }

    public function firstOrCreate($criteria, $data)
    {
        return $this->modelInstance->firstOrCreate(
            $criteria,
            $data
        );
    }

    public function where(array $whereArray, array $columns = ['*'], $withRelationships = [])
    {
        return $this->modelInstance->where($whereArray)->with($withRelationships)->first($columns);
    }

    protected function onlyFillable(array $items)
    {
        if (count($this->modelInstance->getFillable()) === 0) {
            return $items;
        }

        $qualified = [];
        foreach ($items as $key => $val) {
            if (in_array($key, $this->modelInstance->getFillable())) {
                $qualified[$key] = $val;
            }
        }

        return $qualified;
    }

    /**
     * @throws RepositoryException
     * @throws BindingResolutionException
     */
    private function makeModelInstance(): Model
    {
        $tryToCreateModel = $this->app->make($this->getModelClassName());

        if (! $tryToCreateModel instanceof Model) {
            throw new RepositoryException("Class {$this->getModelClassName()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->modelInstance = $tryToCreateModel;
    }
}
