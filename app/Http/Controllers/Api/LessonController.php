<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Models\Lesson;
use App\Repositories\LessonRepositoryInterface;
use Illuminate\Support\Facades\Request;


class LessonController extends Controller
{
    /** 
     * Display a listing of the resource.
     */
    private $repository;
    function __construct(LessonRepositoryInterface $repository)
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
    public function store(LessonRequest $request)
    {
        //
        $all = $request->all();
        if ($request->file('lesson_file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/lessons/'), $fileName);
            $all["lesson_file"] = $fileName;
        }
        return $this->success($this->repository->create($all));

    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LessonRequest $request, int $lesson)
    {
        //
        return $this->success($this->repository->update( $this->repository->getById($lesson), $request->all()));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $lesson)
    {
        //
        $this->repository->delete($this->repository->getById($lesson));
        return $this->success([], "lessons deleted with success");

    }


    function classroomLessons(int $id){

        return $this->success($this->repository->getByClassId($id));
    }
    function uploadExamPdf(Request $request, int $id)
    {
        if ($request->hasFile("course_file")) {
            $file = $request->file('course_file');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/lessons/';


            $lesson = $this->repository->getById($id);

            $oldImage = $lesson->image ?? null;

            $file->move($path, $fileName);

            $lesson = $this->repository->update($lesson, ["image" => $fileName]);

            if ($oldImage) {
                $oldImagePath = $path . $oldImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }
    }
}
