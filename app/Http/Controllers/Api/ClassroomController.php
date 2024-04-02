<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Repositories\ClassroomRepositoryInterface;


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
        return response()->json(
            [
                "status" => true
                ,
                'data' => ['user' => $this->repository->paginate(5)]
                ,
                "message" => "message loadeing successfuly"
            ]
        );
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

        return response()->json(
            [
                "status" => true
                ,
                'data' => ['user' => $this->repository->create($request->all())]
                ,
                "message" => "message created successfuly"
            ]
        );
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
        return response()->json(
            [
                "status" => true
                ,
                'data' => ['user' => $this->repository->update($Classroom, $request->all())]
                ,
                "message" => "message updated successfuly"
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $Classroom)
    {
        //
        $this->repository->delete($Classroom);
        return response()->json(
            [
                "status" => true
                ,
                'data' => []
                ,
                "message" => "message updated successfuly"
            ]
        );
    }
}
