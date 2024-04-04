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

    }

    public function store(StudentRequest $request)
    {


        $user = $this->repository->create($request->all());

        return $this->success($user, "users created successfully", 201);
    }
    public function show(int $id)
    {
        $user = $this->repository->getById($id);
        if ($user)
            return response()->json(
                [
                    "status" => true
                    ,
                    'data' => $user

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
            'username' => 'required|string|max:100',
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:100',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'required|min:4',
            'role_id' => 'required|in:1,2,3',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation errors occurred.'
            ], 422);
        }


        $user = $this->repository->update($user, $request->all());

        return $this->success($user, "users updated successfully");
    }
    public function destroy(User $user)
    {
        $this->repository->delete($user);

        return $this->success([], "user deleted whith success");
    }


}
