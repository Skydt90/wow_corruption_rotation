<?php


namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseServiceInterface
{
    public function get(): Collection;

    public function getById(int $id): Model;

    public function getWhere(string $column, $value): Collection;

    public function getPaginated(int $amount): LengthAwarePaginator;

    public function getByIdWithRelations(int $id, array $relations): Model;

    public function create(Request $request): Model;

    public function updateById(Request $request, int $id): Model;

    public function updateWhere(Request $request, string $column, $value): Model;

    public function updateModel(Request $request, Model $model);

    public function find(array $values): Collection;

    public function delete(Model $model);

    public function destroy(int $id): bool;
}
