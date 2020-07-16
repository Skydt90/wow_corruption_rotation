<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseService implements BaseServiceInterface
{
    /**
     * This points to the repo related to the implementing service
     *
     * @property App\Repositories
     */
    protected $repo;

    public function get(): Collection
    {
        return $this->repo->get();
    }

    public function getById(int $id): Model
    {
        return $this->repo->getById($id);
    }

    public function getWhere(string $column, $value): Collection
    {
        return $this->repo->getWhere($column, $value);
    }

    public function getPaginated(int $amount): LengthAwarePaginator
    {
        return $this->repo->getPaginated($amount);
    }

    public function getByIdWithRelations(int $id, array $relations): Model
    {
        return $this->repo->getByIdWithRelations($id, $relations);
    }

    public function create(Request $request): Model
    {
        return $this->repo->create($request);
    }

    public function updateById(Request $request, int $id): Model
    {
        return $this->repo->updateById($request, $id);
    }

    public function updateWhere(Request $request, string $column, $value): Model
    {
        return $this->repo->updateWhere($request, $column, $value);
    }

    public function updateModel(Request $request, Model $model)
    {
        return $this->repo->updateModel($request, $model);
    }

    public function find(array $values): Collection
    {
        return $this->repo->find($values);
    }

    public function delete(Model $model)
    {
        return $this->repo->delete($model);
    }

    public function destroy(int $id): bool
    {
        return $this->repo->destroy($id);
    }
}
