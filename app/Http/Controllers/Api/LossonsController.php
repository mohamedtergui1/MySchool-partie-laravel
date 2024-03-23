<?php

namespace App\Http\Controllers;

use App\Http\Requests\LossonsRequest;
use App\Models\Lossons;
use App\Repositories\LossonsRepositoryInterface;


class LossonsController extends Controller
{ 
    /**
     * Display a listing of the resource.
     */
    private $repository;
    function __construct(LossonsRepositoryInterface $repository){
        $this->repository = $repository;
    }
    



    public function index()
    {
        return response()->json([
            "status" => true 
            ,
            "data" => $this->repository->paginate(10)
            ,
            "message" => "lessons found"
        ]);
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
    public function store(LossonsRequest $request)
    {
        //
        $all = $request->all();
        if ($request->file('course_file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads'), $fileName);  
            $all["course_file"] = $fileName;
        }
        return response()->json([
            "status" => true 
            ,
            "data" => $this->repository->create($all)
            ,
            "message" => "lessons found"
        ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Lossons $lossons)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lossons $lossons)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LossonsRequest $request, Lossons $lossons)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lossons $lossons)
    {
        //
    }
}
