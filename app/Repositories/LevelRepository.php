<?php

namespace App\Repositories;

use App\Models\Level;

class LevelRepository
{
    public function create(array $data)
    {
        return Level::create($data);
    }

    public function update(Level $Level, array $data)
    {
        $Level->update($data);
        return $Level;
    }

    public function delete(Level $Level)
    {
        return $Level->delete();
    }

    public function getById(int $id)
    {
        return Level::find($id);
    }


    public function getAll()
    {
        return Level::all();
    }
    public function paginate(int $Nrows)
    {
        return Level::paginate($Nrows);
    }
}
