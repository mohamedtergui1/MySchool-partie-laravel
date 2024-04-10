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

    public function getAll()
    {
        return User::all();
    }
    public function paginate(int $Nrows)
    {
        $users = User::latest()->where("id","<>",Auth::id())->where("role_id","<>","1")->paginate($Nrows);
        $users->load("role", "grade");
        return $users;

    }
}
