<?php

namespace App\Policies;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AnnoncePolicy
{
   
    public function view(User $user, Annonce $annonce): bool
    {
        //
        return $user->id == $annonce->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
 
}
