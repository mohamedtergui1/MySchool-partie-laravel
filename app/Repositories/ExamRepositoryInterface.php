<?php

namespace App\Repositories;

use App\Models\Exam;

interface ExamRepositoryInterface
{
    public function create(array $data);

    public function update(Exam $Exam, array $data);

    public function delete(Exam $Exam);

    public function getById(int $id);


    public function getAll();

    public function paginate(int $Nrows);
    public function getByClassId(int $is);
    public function getClassExams ($id);
    public function getExamsClassroomStudent(int $id);
}
