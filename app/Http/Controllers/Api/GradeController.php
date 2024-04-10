<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Repositories\GradeRepositoryInterface;

class GradeController extends Controller
{
    private $repository;
    function __construct(GradeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    function index()
    {
        return $this->success($this->repository->paginate(10));
    }
    function indexAll()
    {
        return $this->success($this->repository->getAll());
    }

    function store(Request $request)
    {
        return $this->success($this->repository->create($request->all()), "Grade added with success");
    }


    function update(Request $request, Grade $Grade)
    {
        return $this->success($this->repository->update($Grade, $request->all()), "Grade updated with success");
    }


    function destroy(Grade $Grade)
    {
        $this->repository->delete($Grade);
        return $this->success([], "Grade deleted with success");
    }

}
