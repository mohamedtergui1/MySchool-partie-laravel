<?php

namespace App\Policies;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExamPolicy
{
   
    public function view(User $user, Exam $exam): bool
    {
        //
        return $exam->classroom->teacher_id == $user->id;

    }

   
}
