<?php

namespace App\Repositories;

use App\Models\Result;


class ResultRepository implements ResultRepositoryInterface
{
    public function create(array $data)
    {

        return Result::create($data);
    }

    public function update(Result $Result, array $data)
    {
        $Result->update($data);
        return $Result; 
    }
    public function delete(Result $Result)
    {
        return $Result->delete();
    }
    public function getById(int $id)
    {
        return Result::find($id);
    }
    public function getAll()
    {
        return Result::all();
    }
    public function paginate(int $Nrows)
    {
        return Result::latest()->paginate($Nrows);
    }
    public function getResultExam(int $idExam){
        return Result::with("student")->whereHas("exam", function ($query) use ($idExam) {
            $query->where('exams.id', $idExam);
        })->get();
    }

}
