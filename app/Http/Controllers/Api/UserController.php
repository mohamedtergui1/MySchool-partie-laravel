<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    private $repository;
    function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        $users = $this->repository->paginate(5);
        if ($users->count()) {
            return response()->json(
                [
                    "status" => true
                    ,
                    'data' => [
                    'users' => $users]
                    ,
                    "message" => "users loading successfully"
                ]
           ,200 );
        } else {
            return response()->json(
                [
                    "status" => false
                    ,
                    "message" => "no records found"
                ]
            );
        }
    }
   
    


}
