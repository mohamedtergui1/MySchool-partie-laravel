<?php

namespace App\Repositories;

use App\Models\Lossons;


class LossonsRepository implements LossonsRepositoryInterface
{
    public function create(array $data)
    {
        return Lossons::create($data);
    }

    public function update(Lossons $Lossons, array $data)
    {
        $Lossons->update($data);
        return $Lossons;
    }

    public function delete(Lossons $Lossons)
    {
        $Lossons->delete();
    }

    public function getById(int $id)
    {
        return Lossons::find($id);
    }
    public function getByEmail(string $email)
    {
        return Lossons::where("email", $email)->firstOrFail();
    }

    public function getAll()
    {
        return Lossons::all();
    }
    public function paginate(int $Nrows)
    {
        return Lossons::latest()->paginate($Nrows);
    }
}
