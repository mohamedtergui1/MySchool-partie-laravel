<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Role;
use App\Models\User;

class TeacherRole implements Rule
{
    public function passes($attribute, $value)
    {
        // Retrieve the teacher role
        $teacherRole = Role::where('name', 'teacher')->first();

        // Check if the user with the specified ID has the teacher role
        return User::find($value)->role->name == $teacherRole->name;
    }

    public function message()
    {
        return 'The selected teacher must have a teacher role.';
    }
}
