<?php

namespace App\Repositories;

use App\Models\Absense;

class AbsenseRepository
{
    public function create(array $data)
    {
        return Absense::create($data);
    }

    public function update(Absense $Absense, array $data)
    {
        $Absense->update($data);
        return $Absense;
    }

    public function delete(Absense $Absense)
    {
        return $Absense->delete();
    }

    public function getById(int $id)
    {
        return Absense::find($id);
    }


    public function getAll()
    {
        return Absense::all();
    }
    public function paginate(int $Nrows)
    {
        return Absense::paginate($Nrows);
    }
}
