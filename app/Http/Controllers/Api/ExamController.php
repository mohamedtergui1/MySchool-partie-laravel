<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Repositories\ExamRepositoryInterface;
class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $repository;
    function __construct(ExamRepositoryInterface $repository)
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
        return $this->success($this->repository->create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $exam)
    {
        //
        return $this->success($this->repository->update($this->repository->getById($exam),$request->all()));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $exam)
    {
        //
        $this->repository->delete($this->repository->getById($exam));
        return $this->success();
    }
}
