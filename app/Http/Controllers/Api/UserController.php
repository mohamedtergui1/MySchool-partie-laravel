<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;


use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

 abstract class UserController extends Controller
{

    protected $repository;
    function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
      abstract function index();

    abstract public function store(UserRequest $request);
    
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
                    "message" => "User created successfully"
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



    public function update(UserUpdateRequest $request, int $user)
    {





        $user = $this->repository->getById($user);
        $validator = Validator::make($request->all(), [
            // 'username' => 'required|string|max:100',
            // 'email' => [
            //     'required',
            //     'string',
            //     'lowercase',
            //     'email',
            //     'max:100',
            //     Rule::unique('users')->ignore($user->id, 'id'),
            // ]

            // ,

            // 'role_id' => 'in:3',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => "Validation errors occurred."
            ], 422);
        }

        $all = $request->all();

        if ($request->hasFile("image")) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/Users/';
            $file->move($path, $fileName);
            $all["image"] = $fileName;
        }

        $user = $this->repository->update($user, $all);

        return $this->success($user, "User updated successfully");
    }
    public function destroy(int $user)
    {
        $user = $this->repository->getById($user);
        $this->repository->delete($user);
        return $this->success([], "User deleted whith success");
    }
 
}
