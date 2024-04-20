<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Repositories\ClassroomRepositoryInterface;
use Illuminate\Http\Request;


class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $repository;
    function __construct(ClassroomRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function index() 
    {
        return $this->success($this->repository->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassroomRequest $request)
    {
        //
        return $this->success($this->repository->create($request->all()), "message created successfuly");
         
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassroomController $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassroomController $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassroomRequest $request, Classroom $Classroom)
    {
        //

        return $this->success($this->repository->update($Classroom, $request->all()), "classroom updated successfuly");
         
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $Classroom)
    {
        //
        $this->repository->delete($Classroom);
        return $this->success([], "Classroom deleted with success" );
    }



    function syncStudents(Request $request , int $classroom){
        return $this->success($this->repository->syncStudents($classroom ,  $request->student_ids));
    }



    function getClassroomsForLesson(){
        return $this->success($this->repository->teacherClassrooms());
    }

  
}
