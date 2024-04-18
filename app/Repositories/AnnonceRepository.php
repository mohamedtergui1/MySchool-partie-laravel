<?php

namespace App\Repositories;

use App\Models\Annonce;


class AnnonceRepository implements AnnonceRepositoryInterface
{
    public function create(array $data)
    {
        $annonce = Annonce::create($data);
        $annonce->load("user");
        return $annonce;
    }

    public function update(Annonce $Annonce, array $data)
    {
        $Annonce->update($data);
        $Annonce->load("user");
        return $Annonce;
    }
    public function delete(Annonce $Annonce)
    {
        return $Annonce->delete();
    }
    public function getById(int $id)
    {
        return Annonce::find($id);
    }
    public function getAll()
    {
        $annonces = Annonce::all();
        $annonces->load("user");
        return $annonces;
    }
    public function paginate(int $Nrows) 
    {
        $annonces = Annonce::latest()->paginate($Nrows);
        $annonces->load("user");
        return $annonces;
    }
}
