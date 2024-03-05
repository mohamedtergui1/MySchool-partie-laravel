<?php

namespace App\Repositories;

use App\Models\Result;

class ResultRepository
{
    public function create(array $data)
    {
        return Result::create($data);
    }

    public function update(Result $Result, array $data)
    {
        $Result->update($data);
        return $Result;
    }

    public function delete(Result $Result)
    {
        return $Result->delete();
    }

    public function getById(int $id)
    {
        return Result::find($id);
    }


    public function getAll()
    {
        return Result::all();
    }
    public function paginate(int $Nrows)
    {
        return Result::paginate($Nrows);
    }
}
