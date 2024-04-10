<?php

namespace App\Repositories;

use App\Models\Promo;


class PromoRepository implements PromoRepositoryInterface
{
    public function create(array $data)
    {

        return Promo::create($data);
    }

    public function update(Promo $Promo, array $data)
    {
        $Promo->update($data);
        return $Promo;
    }
    public function delete(Promo $Promo)
    {
        return $Promo->delete();
    }
    public function getById(int $id)
    {
        return Promo::find($id);
    }
    public function getAll()
    {
        return Promo::orderByDesc("year")->get();
    }
    public function paginate(int $Nrows)
    {
        return Promo::orderByDesc("year")->paginate($Nrows);
    }
}
