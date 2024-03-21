<?php

namespace App\Repositories;

use App\Models\Scholasticyear;


class ScholasticyearRepository implements ScholasticyearRepositoryInterface
{
    public function create(array $data)
    {   
       
        return  Scholasticyear::create($data); 
    }
    
    public function update(Scholasticyear $Scholasticyear, array $data)
    {
        $Scholasticyear->update($data);
        return $Scholasticyear;
    } 
    public function delete(Scholasticyear $Scholasticyear)
    {
        return $Scholasticyear->delete();
    }
    public function getById(int $id)
    {
        return Scholasticyear::find($id);
    }
    public function getAll()
    {
        return Scholasticyear::all();
    }
    public function paginate(int $Nrows){
        return Scholasticyear::paginate($Nrows);
    }
}
