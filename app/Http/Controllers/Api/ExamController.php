<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Repositories\ExamRepositoryInterface;
use App\Http\Requests\ExamRequest;
use App\Http\Requests\UpdateExamRequest;

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
    public function store(ExamRequest $request)
    {
        //
        return $this->success($this->repository->create($request->all()), "exam added with success");
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
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
    public function update(UpdateExamRequest $request, int $exam)
    {
        //
        return $this->success($this->repository->update($this->repository->getById($exam), $request->all()), "exam updates with success");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $exam)
    {
        //
        $this->repository->delete($this->repository->getById($exam));
        return $this->success([], "exam deleted with success");
    }
    function classroomExams($id)
    {
        return $this->success($this->repository->getByClassId($id));
    }

    function getClassExams($id)
    {
        return $this->success($this->repository->getClassExams($id));
    }

    function uploadExamPdf(Request $request, int $id)
    {
        if ($request->hasFile("exam_file")) {
            $file = $request->file('exam_file');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/lessons/';


            $exam = $this->repository->getById($id);

            $oldImage = $exam->image ?? null;

            $file->move($path, $fileName);

            $exam = $this->repository->update($exam, ["image" => $fileName]);

            if ($oldImage) {
                $oldImagePath = $path . $oldImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }
    }


    function getExamsClassroomStudent($id){
        return $this->success($this->repository->getExamsClassroomStudent($id)) ;
    }
}
