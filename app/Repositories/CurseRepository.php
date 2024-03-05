<?php

namespace App\Repositories;

use App\Models\Curse;

class CurseRepository
{
    public function create(array $data)
    {
        return Curse::create($data);
    }

    public function update(Curse $Curse, array $data)
    {
        $Curse->update($data);
        return $Curse;
    }

    public function delete(Curse $Curse)
    {
        return $Curse->delete();
    }

    public function getById(int $id)
    {
        return Curse::find($id);
    }
    



    public function getAll()
    {
        return Curse::all();
    }
    public function paginate(int $Nrows){
        return Curse::paginate($Nrows);
    }
}
