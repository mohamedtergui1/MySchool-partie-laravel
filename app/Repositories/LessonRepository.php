<?php

namespace App\Repositories;

use App\Models\Lesson;

  
class LessonRepository implements LessonRepositoryInterface
{ 
    public function create(array $data)
    {
        $lesson = Lesson::create($data);
        $lesson->load("classroom"); 
        return $lesson ;
    }

    public function update(Lesson $lesson, array $data)
    {
        $lesson->update($data);
        $lesson->load("classroom");
        return $lesson;
    }

    public function delete(Lesson $Lesson)
    {
       return  $Lesson->delete();
    }

    public function getById(int $id)
    {
        return Lesson::find($id);
    }
   

    public function getAll()
    {
        return Lesson::with("classroom")->all();
    }
    public function paginate(int $Nrows)
    {
        return Lesson::with("classroom")->latest()->paginate($Nrows);
    }
}
