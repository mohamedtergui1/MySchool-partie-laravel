<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Repositories\ResultRepositoryInterface;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $repository;
    function __construct(ResultRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        //
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
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        //
    }
    function getResultExam(int $id)
    {
        return $this->success($this->repository->getResultExam($id));
    }

    function setResultExam(Request $request)
    {

        foreach ($request->notes as $note) {
            if ($note[1] > 20 || $note[1] < 0) {
                return $this->failed(['note' => ["the note must be between  0 and 20 "]], 422);
            }
        }
        foreach ($request->notes as $note) {
            $result = $this->repository->getById($note[0]);
            if (gettype($note[1]) == "integer" || gettype($note[1]) == "double")
                $this->repository->update($result, ["note" => $note[1]]);
        }
        $exam = Exam::find($result->exam_id);
        $exam->update(["corrected" => 1]);

        return $this->success([], "results updated with success");
    }

    function getAllResultsClassroom($id)
    {
        return $this->success($this->repository->getAllResultsClassroom($id));
    }
}
