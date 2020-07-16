<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

interface BaseRepoInterface
{
    public function get();

    public function getById(int $id);

    public function getWhere(string $column, $value);

    public function getOrderBy(string $column, $value);

    public function getPaginated(int $amount);

    public function getByIdWithRelations(int $id, array $relations);

    public function create(Request $request);

    public function firstOrCreate(array $values);

    public function updateById(Request $request, int $id);

    public function updateWhere(Request $request, string $column, $value);

    public function updateModel(Request $request, Model $model);

    public function find(array $values);

    public function delete(Model $model);

    public function destroy(int $id): bool;
}
