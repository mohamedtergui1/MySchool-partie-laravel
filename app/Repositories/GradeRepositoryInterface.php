<?php

namespace App\Repositories;

use App\Models\Grade;

interface GradeRepositoryInterface
{
    public function create(array $data);

    public function update(Grade $Grade, array $data);

    public function delete(Grade $Grade);

    public function getById(int $id);


    public function getAll();

    public function paginate(int $Nrows);
}
