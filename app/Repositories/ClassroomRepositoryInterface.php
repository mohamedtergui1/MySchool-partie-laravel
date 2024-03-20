<?php 
namespace App\Providers;

interface ClassroomRepositoryInterface{
    public function create(array $data);

    public function update(Classroom $Classroom, array $data);

    public function delete(Classroom $Classroom);
    public function getById(int $id);
     
    

    public function getAll();
    public function paginate(int $Nrows);
}