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
    function updateProfileImage(Request $request){
        $id = Auth::id();
        $user = $this->repository->getById($id);
        if ($request->hasFile("image")) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/students/';


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
        else return   $this->success($user);
    }
}
