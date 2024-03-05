<?php

namespace App\Repositories;

use App\Models\Equipment;

class EquipmentRepository
{
    public function create(array $data)
    {
        return Equipment::create($data);
    }

    public function update(Equipment $Equipment, array $data)
    {
        $Equipment->update($data);
        return $Equipment;
    }

    public function delete(Equipment $Equipment)
    {
        return $Equipment->delete();
    }

    public function getById(int $id)
    {
        return Equipment::find($id);
    }


    public function getAll()
    {
        return Equipment::all();
    }
    public function paginate(int $Nrows)
    {
        return Equipment::paginate($Nrows);
    }
}
