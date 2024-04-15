<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserRepository implements UserRepositoryInterface
{
    public function create(array $data)
    {
        $user = User::create($data);
        $user->load("role", "grade");
        return $user;
    }

    public function update(User $user, array $data)
    {
        $user->update($data);
        $user->load("role", "grade");
        return $user;
    }

    public function delete(User $User)
    {
        $User->delete();
    }

    public function getById(int $id)
    {
        return User::find($id);
    }
    public function getByEmail(string $email)
    {
        return User::where("email", $email)->first();
    }

    public function getAll(array $role_id = null)
    {
        if ($role_id)
            $users = User::latest()->whereIn("role_id", $role_id)

                ->get();
        else
            $users = User::latest()->get();
        $users->load("role", "grade");
        return $users;
    }
    public function paginate(int $Nrows, array $role_id = null)
    {
        if ($role_id)
            $users = User::latest()->where("id", "<>", Auth::id())->whereIn("role_id", $role_id)

                ->paginate($Nrows);
        else
            $users = User::latest()->where("id", "<>", Auth::id())->paginate($Nrows);
        $users->load("role", "grade");
        return $users;

    }

    public function getAvailableStudents(int $classId)
    {
        $students = User::where("role_id",3)->whereDoesntHave("classrooms", function ($query) use ($classId) {
            $query->where('classrooms.id', $classId); 
        })->get();

        return $students;
    }

}
