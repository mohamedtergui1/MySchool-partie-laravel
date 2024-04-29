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
            $users = User::latest()->whereIn("role_id", $role_id)->where("id", "<>", Auth::id())
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
        $students = User::where("role_id", 3)->whereDoesntHave("classrooms", function ($query) use ($classId) {
            $query->where('classrooms.id', $classId);
        })->get();

        return $students;

    }
    public function getStudentByClassroomId(int $id)
    {
        return User::where("role_id", 3)->whereHas("classrooms", function ($query) use ($id) {
            $query->where('classrooms.id', $id);
        })->get();
    }
    public function getStudentClassrooms()
    {
        $id = Auth::id();
        $user = User::with('classrooms.grade', 'classrooms.promo', 'classrooms.teacher', 'classrooms.students')->find($id);
        return $user;
    }


    public function search(array $request)
    {

        $query = User::with("grade")
            ->where(function ($query) use ($request) {
                $query->where("firstName", 'like', '%' . $request['name'] . '%')
                    ->orWhere("lastName", "like", '%' . $request['name'] . '%');
            })->where("role_id", 3);

        if ($request["grade"]) {
            $query->Where("grade_id", $request["grade"]);
        }

        if ($request["genre"]) {
            $query->Where("genre", $request["genre"]);
        }

        return $query->paginate(10);
    }



}
