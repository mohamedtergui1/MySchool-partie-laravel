<?php

namespace App\Policies;

use App\Models\Result;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ResultPolicy
{



    public function view(User $user, Exam $exam): bool
    {
        //

        return $exam->classroom->teacher_id == $user->id;

    }
   

    

 
}
