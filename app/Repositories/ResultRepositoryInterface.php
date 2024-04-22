<?php

namespace App\Repositories;

use App\Models\Result;

interface ResultRepositoryInterface
{ 
    public function create(array $data);

    public function update(Result $Result, array $data);

    public function delete(Result $Result);

    public function getById(int $id);


    public function getAll();

    public function paginate(int $Nrows);
    public function getResultExam(int $idExam);


}
