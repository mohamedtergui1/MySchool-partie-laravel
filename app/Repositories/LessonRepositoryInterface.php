<?php

namespace App\Repositories;

use App\Models\Lesson;

interface LessonRepositoryInterface
{
    public function create(array $data);
 
    public function update(Lesson $Lesson, array $data);

    public function delete(Lesson $Lesson);

    public function getById(int $id);

    

    public function getAll();

    public function paginate(int $Nrows);
}
