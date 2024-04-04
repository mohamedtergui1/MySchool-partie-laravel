<?php

namespace App\Repositories;

use App\Models\Promo;

interface PromoRepositoryInterface
{
    public function create(array $data); 

    public function update(Promo $Promo, array $data);

    public function delete(Promo $Promo);

    public function getById(int $id);


    public function getAll();

    public function paginate(int $Nrows);
}
