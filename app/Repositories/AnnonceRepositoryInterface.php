<?php

namespace App\Repositories;

use App\Models\Annonce;

interface AnnonceRepositoryInterface
{
    public function create(array $data);

    public function update(Annonce $Annonce, array $data);

    public function delete(Annonce $Annonce);

    public function getById(int $id);


    public function getAll();

    public function paginate(int $Nrows);
}
