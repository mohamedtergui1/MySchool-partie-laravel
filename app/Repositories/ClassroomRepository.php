<?php

namespace App\Repositories;

use App\Models\Classroom;
use App\Providers\ClassroomRepositoryInterface;

class ClassroomRepository implements ClassroomRepositoryInterface
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
    public function getAll()
    {
        return Classroom::all();
    }
    public function paginate(int $Nrows){
        return Classroom::paginate($Nrows);
    }
}
