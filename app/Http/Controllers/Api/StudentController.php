<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;

use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    private $repository;
    function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {

        return $this->success($this->repository->paginate(10,[3]));

    }

    function getStudents(){
        return $this->success($this->repository->getAll([3]));
    }

    public function store(StudentRequest $request)
    {


       
        if ($request->hasFile("image")) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/students/';
            $file->move($path, $fileName);
            $all["image"] = $fileName;
        }   
        $user = $this->repository->create($all);
        return $this->success($user, "student created successfully", 201);
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
                    "message" => "student created successfully"
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



    public function update(Request $request,int $user)
    {



      

        $user = $this->repository->getById($user);
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:100',
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:100',
                Rule::unique('users')->ignore($user->id, 'id'),
            ]

            ,
        
            'role_id' => 'in:3',
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
            $path = 'uploads/students/';
            $file->move($path, $fileName);
            $all["image"] = $fileName;
        }

        $user = $this->repository->update($user, $all);

        return $this->success($user, "student updated successfully");
    }
    public function destroy(int $user)
    {
        $user = $this->repository->getById($user);
        $this->repository->delete($user);
        return $this->success([], "student deleted whith success");
    }
    function getAvailableStudents(int $id)
    {
        return $this->success($this->repository->getAvailableStudents($id));
    }
}
