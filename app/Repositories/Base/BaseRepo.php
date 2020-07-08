<?php

namespace App\Repositories\Base;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepo implements BaseRepoInterface
{
    /**
     * This points to the model related to the implementing repo
     *
     * @property Illuminate\Database\Eloquent\Model
     */
    protected $model;

    public function create(Request $request): Model
    {
        return $this->model->create($request->all());
    }

    public function firstOrCreate(array $values): Model
    {
        return $this->model->firstOrCreate($values);
    }

    public function updateById(Request $request, int $id): Model
    {
        $model = $this->model->findOrFail($id);
        $model->fill($request->all());
        $model->save();
        return $model;
    }

    public function updateWhere(Request $request, string $column, $value): Model
    {
        $model = $this->model->where($column, $value)->firstOrFail();
        $model->fill($request->all());
        $model->save();
        return $model;
    }

    public function updateModel(Request $request, Model $model)
    {
        $model->fill($request->all());
        $model->save();
        return $model;
    }

    public function getById(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function getOrderBy($column, $value): Model
    {
        return $this->model->orderBy($column, $value)->first();
    }

    public function getByIdWithRelations(int $id, array $relations): Model
    {
        return $this->model->with($relations)->findOrFail($id);
    }

    public function get(): Collection
    {
        return $this->model->all();
    }

    public function getPaginated(int $amount): LengthAwarePaginator
    {
        return $this->model->paginate($amount);
    }

    public function getWhere(string $column, $value): Model
    {
        return $this->model->where($column, $value)->first();
    }

    public function find(array $values): Collection
    {
        return $this->model->find($values);
    }

    public function delete(Model $model)
    {
        return $model->delete();
    }

    public function destroy(int $id): bool
    {
        return $this->model->findOrFail($id)->destroy($id);
    }
}
