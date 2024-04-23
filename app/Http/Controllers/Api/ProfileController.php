<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends ExamController
{
    //

    private $repository;
    function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    function updateProfile(Request $request ){
        $id = Auth::id();
        return $this->success($this->repository->update($this->repository->getById($id),$request->all()),"profile updated with success"); 
    } 
    function changePassword(Request $request){

    }
}
