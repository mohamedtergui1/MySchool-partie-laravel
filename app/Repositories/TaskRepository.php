<?php

namespace App\Repositories;

use App\Models\Classroom;

class ClassroomRepository
{
    public function create(array $data)
    {
        return Classroom::create($data);
    }

    public function update(Classroom $Classroom, array $data)
    {
        $Classroom->update($data);
        return $Classroom;
    }

    public function delete(Classroom $Classroom)
    {
        return $Classroom->delete();
    }

    public function getById(int $id)
    {
        return Classroom::find($id);
    }
    public function getByUserId(int $id)
    {
        return Classroom::where("user_id", $id)->get();
    }



    public function getAll()
    {
        return Classroom::all();
    }
}
