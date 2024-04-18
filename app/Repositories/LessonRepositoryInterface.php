<?php

namespace App\Repositories;

use App\Models\Lossons;

interface LessonRepositoryInterface
{
    public function create(array $data);

    public function update(Lossons $Lossons, array $data);

    public function delete(Lossons $Lossons);

    public function getById(int $id);

    public function getByEmail(string $email);

    public function getAll();

    public function paginate(int $Nrows);
}
