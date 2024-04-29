<?php

namespace App\Repositories;

use App\Models\Result;
use Illuminate\Support\Facades\Auth;


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
    public function getResultExam(int $idExam)
    {
        return Result::with("student")->whereHas("exam", function ($query) use ($idExam) {
            $query->where('exams.id', $idExam);
        })->get();
    }


    public function getAllResultsClassroom(int $id)
    {
        $id_user = Auth::id();
        return Result::with("exam")->where("student_id", $id_user)->whereHas("exam", function ($query) use ($id) {
            return $query->Where("classroom_id", $id)->where("corrected",true);
        })->get();
    }

}
