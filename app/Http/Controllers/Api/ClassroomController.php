<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ClassroomRepository;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $repository;
    function __construct(ClassroomRepository $repository){
          $this->repository = $repository;
    }
    public function index()
    {
        return response()->json(
            [
                "status" => true
                ,
                'data' => ['user' => $this->repository->getAll()]
                ,
                "message" => "message loadeing successfuly"
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, ClassroomController $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassroomController $cr)
    {
        //
    }
}
