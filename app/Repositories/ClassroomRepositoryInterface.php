<?php 
namespace App\Repositories;

use App\Models\Classroom;

interface ClassroomRepositoryInterface{
    public function create(array $data);

    public function update(Classroom $Classroom, array $data);

    public function delete(Classroom $Classroom);
    public function getById(int $id);
     
    

    public function getAll(); 
    public function paginate(int $Nrows);
    public function syncStudents(int $Classroom, array $data);
}