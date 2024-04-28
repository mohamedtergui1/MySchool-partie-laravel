<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
 

use App\Repositories\UserRepository;
 
 abstract class UserController extends Controller
{

    protected $repository;
    function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
     
 
}
