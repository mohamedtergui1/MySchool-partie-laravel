<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data);

    public function update(User $User, array $data);

    public function delete(User $User);
    public function getById(int $id);

    public function getByEmail(string $email);

    public function getAll(array $role_id = null);

    public function paginate(int $Nrows, array $role_id = null);
    public function getAvailableStudents(int $classId);
}
