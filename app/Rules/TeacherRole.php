<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Role;
use App\Models\User;

class TeacherRole implements Rule
{
    public function passes($attribute, $value)
    {
        
        $teacherRole = Role::where('name', 'teacher')->first();

         
        return User::find($value)->role->name == $teacherRole->name;
    }

    public function message()
    {
        return 'The selected teacher must have a teacher role.';
    }
}
