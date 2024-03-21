<?php 
namespace App\Repositories;
use App\Models\Scholasticyear;

interface ScholasticyearRepositoryInterface{
    public function create(array $data);

    public function update(Scholasticyear $Scholasticyear, array $data);

    public function delete(Scholasticyear $Scholasticyear);
    public function getById(int $id);
     
    

    public function getAll();
    public function paginate(int $Nrows);
}