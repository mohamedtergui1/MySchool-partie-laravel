<?php

namespace App\Repositories;

use App\Models\Exam;


class ExamRepository implements ExamRepositoryInterface
{
    public function create(array $data)
    {
        $exam = Exam::create($data);
        $student_ids = $exam->classroom->students->pluck('id');
        $exam->students()->attach($student_ids);
        $exam->load("classroom.promo", "results.student");
        return $exam;
    }
    public function update(Exam $exam, array $data)
    {
        $exam->update($data);
        $exam->load("classroom.promo", "results.student");
        return $exam;
    }

    public function delete(Exam $exam)
    {
        return $exam->delete();
    }

    public function getById(int $id)
    {
        return Exam::with("classroom", "results.student")->find($id);
    }

    public function getAll()
    {
        return Exam::with("classroom", "results.student")->get();
    }

    public function paginate(int $rowsPerPage)
    {
        return Exam::latest()->with("classroom.promo", "results.student")->paginate($rowsPerPage);
    }
    public function getByClassId(int $id)
    {
        return Exam::with("results.student")->whereHas("classroom", function ($query) use ($id) {
            $query->where("classrooms.id", $id);
        })->get();
    }
    public function getClassExams($id){
        return Exam::with("results.student")->where("classroom_id",$id)->get();
    }
     
}
