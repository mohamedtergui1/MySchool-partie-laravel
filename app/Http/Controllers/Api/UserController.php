<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;

use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

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
                        'users' => $users
                    ]
                    ,
                    "message" => "users loading successfully"
                ]
                ,
                200
            );
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

    public function store(StudentRequest $request)
    {
        $all = $request->all();
        $role = $all["role"];
        unset($all["role"]);
        $user = $this->repository->create($all);

        $user->assignRole($role);

        return response()->json(
            [
                "status" => true
                ,
                'data' => [
                    'users' => $user
                ]
                ,
                "message" => "users created successfully"
            ]
            ,
            201
        );
    }
    public function show(int $id)
    {
        $user = $this->repository->getById($id);
        if ($user)
            return response()->json(
                [
                    "status" => true
                    ,
                    'data' => [
                        'users' => $user
                    ]
                    ,
                    "message" => "user created successfully"
                ]
                ,
                201
            );
        else
            return response()->json(
                [
                    "status" => false
                    ,
                    "message" => "no user found"
                ]
                ,
                404
            );
    }



    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:100',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'required|min:4',
            'role' => 'required|in:student,teacher',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation errors occurred.'
            ], 422);
        }
        $all = $request->all();
        $role = $all["role"];
        unset($all["role"]);
        $user = $this->repository->update($user, $all);
        $user->syncRoles([]);
        $user->assignRole($role);

        return response()->json(
            [
                "status" => true
                ,
                'data' => [
                    'users' => $user
                ]
                ,
                "message" => "users updated successfully"
            ]
            ,
            201
        );
    }



}
