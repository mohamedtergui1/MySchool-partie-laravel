<?php

namespace App\Repositories;

use App\Models\Exam;


class ExamRepository implements ExamRepositoryInterface
{
    public function create(array $data)
    {
        $Exam = Exam::create($data);
        $Exam->load("user");
        return $Exam;
    } 

    public function update(Exam $Exam, array $data)
    {
        $Exam->update($data);
        $Exam->load("user");
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
        $Exams = Exam::all();
        $Exams->load("user");
        return $Exams;
    }
    public function paginate(int $Nrows)
    {
        $Exams = Exam::latest()->paginate($Nrows);
        $Exams->load("user");
        return $Exams;
    }
}
