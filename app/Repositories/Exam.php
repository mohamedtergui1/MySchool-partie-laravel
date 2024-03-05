<?php

namespace App\Repositories;

use App\Models\Exam;

class ExamRepository
{
    public function create(array $data)
    {
        return Exam::create($data);
    }

    public function update(Exam $Exam, array $data)
    {
        $Exam->update($data);
        return $Exam;
    }

    public function delete(Exam $Exam)
    {
        return $Exam->delete();
    }

    public function getById(int $id)
    {
        return Exam::find($id);
    }


    public function getAll()
    {
        return Exam::all();
    }
    public function paginate(int $Nrows)
    {
        return Exam::paginate($Nrows);
    }
}
