<?php

namespace App\Http\Controllers\Api;

 
use App\Http\Requests\StudentRequest;

 
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class StudentController extends UserController
{
 
    public function index()
    {
 
        return $this->success($this->repository->paginate(10, [3]));

    }

    function getStudents()
    {
        return $this->success($this->repository->getAll([3]));
    }

    public function store(StudentRequest $request)
    {



        $user = $this->repository->create($request->all() + ["role_id" => 3]);
        return $this->success($user, "student created successfully", 201);
    }
    public function show(int $id)
    {

    }



    public function update(Request $request, int $user)
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



        $user = $this->repository->update($user, $request->all());

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
    function changeImage(Request $request, int $id)
    {
        if ($request->hasFile("image")) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/students/';


            $user = $this->repository->getById($id);
            $oldImage = $user->image ?? null;

            $file->move($path, $fileName);


            $user = $this->repository->update($user, ["image" => $fileName]);


            if ($oldImage) {
                $oldImagePath = $path . $oldImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            return $this->success($user, "Image updated successfully");
        } else if ($request->image == "") {
            $user = $this->repository->getById($id);
            $oldImage = $user->image ?? null;
            $path = 'uploads/students/';
            $user = $this->repository->update($user, ["image" => null]);
            if ($oldImage) {
                $oldImagePath = $path . $oldImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            return $this->success($user, "Image deleted successfully");

        }

    }
 
    function classroomStudents(int $id){
        return $this->success($this->repository->getStudentByClassroomId($id));
    }

    function getStudentClassrooms(){
        return $this->success($this->repository->getStudentClassrooms());
    }


    function search(Request $request){
        $all = $request->all();
        return $this->success($this->repository->search($all));
    }

}

