<?php

namespace App\Repositories;

use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;


class ClassroomRepository implements ClassroomRepositoryInterface
{
    public function create(array $data)
    {
        if (isset($data["student_ids"])) {
            $students = $data["student_ids"];
            unset($data["students"]);
            $classroom = Classroom::create($data);


            $classroom->students()->attach($students);
        } else
            $classroom = Classroom::create($data);

        $classroom->load(["promo", "grade", "teacher", "students"]);

        return $classroom;
    }
    public function update(Classroom $Classroom, array $data)
    {
        if (isset($data["student_ids"])) {
            $students = $data["student_ids"];
            unset($data["student_ids"]);
            $Classroom->update($data);
            $Classroom->students()->sync($students);
        }else
        $Classroom->update($data);
        $Classroom->load(["promo", "grade", "teacher", "students"]);
        return $Classroom;
    }
    public function delete(Classroom $Classroom)
    {
        return $Classroom->delete();
    }
    public function getById(int $id)
    {
        return Classroom::find($id);
    }
    public function getAll()
    {
        return Classroom::with(['students', 'teacher', 'grade', 'promo'])->latest()->get();
    }
    public function paginate(int $Nrows)
    {
        return Classroom::with(['students', 'teacher', 'grade', 'promo'])->latest()->paginate($Nrows);
    }
  
    public function syncStudents(int $Classroom, array $data)
    {


        $Classroom = $this->getById($Classroom);
        $Classroom->students()->sync($data);
        $Classroom->load('students', 'teacher', 'grade', 'promo');
        return $Classroom;
    }

    public function teacherClassrooms(){
        $user = Auth::user();
        if ($user->role_id = 1 || $user->role_id = 4)
            return Classroom::all();
        else
           return $user->teacherClassroom;
    }


}
