<?php

namespace App\Repositories;

use App\Models\Grade;


class GradeRepository implements GradeRepositoryInterface
{
    public function create(array $data)
    {

        return Grade::create($data);
    }

    public function update(Grade $Grade, array $data)
    {
        $Grade->update($data);
        return $Grade;
    }
    public function delete(Grade $Grade)
    {
        return $Grade->delete();
    }
    public function getById(int $id)
    {
        return Grade::find($id);
    } 
    public function getAll()
    {
        return Grade::all();
    }
    public function paginate(int $Nrows)
    {
        return Grade::latest()->paginate($Nrows);
    }
}
