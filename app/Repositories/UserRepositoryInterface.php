<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function create(array $data);

    public function update(User $User, array $data);

    public function delete(User $User);

    public function getById(int $id);

    public function getByEmail(string $email);

    public function getAll();

    public function paginate(int $Nrows);
}
