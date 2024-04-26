<?php

use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\PromoController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\AnnonceController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\ResultController;




 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use Symfony\Component\HttpKernel\Profiler\Profile;

/* 
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/forgot-password', [AuthController::class, 'forgot']);
Route::post('/reset-password', [AuthController::class, 'reset']);

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});




Route::group(['middleware' => ['auth','role:admin']], function () {

        Route::apiResource("admin/students", StudentController::class);
        Route::apiResource("admin/employees", EmployeeController::class);
        Route::get("admin/allstudents", [StudentController::class, 'getStudents']);
        Route::post("/admin/students/changeImage/{id}", [StudentController::class, 'changeImage']);
        Route::get("admin/allteachers", [EmployeeController::class, 'getTeachers']);
        Route::post("/admin/employees/changeImage/{id}", [EmployeeController::class, 'changeImage']);
        Route::apiResource("admin/promos", PromoController::class);
        Route::get("admin/allpromos", [PromoController::class, 'indexAll']);
        Route::apiResource("admin/grades", GradeController::class);
        Route::get("admin/allgrades", [GradeController::class, 'indexAll']);
        Route::apiResource("admin/classrooms", ClassroomController::class);
        Route::get("/admin/getAvailableStudents/{id}", [StudentController::class, "getAvailableStudents"]);
        Route::put("/admin/syncStudents/{id}", [ClassroomController::class, "syncStudents"]);
        Route::get("/classrooms/lesson", [ClassroomController::class, "getClassroomsForLesson"]);
        Route::get("/teacher/resultexam/{id}", [ResultController::class, "getResultExam"]);
        Route::post("/teacher/updateResult", [ResultController::class, "setResultExam"]);  
        
    });
    
    Route::group(['middleware' => ['auth', 'role:admin|teacher']], function () {
        
        Route::apiResource("admin/annonces", AnnonceController::class);
        Route::apiResource("/teacher/exams", ExamController::class);
        Route::apiResource("/teacher/Lessons", LessonController::class);
        Route::put("/updateProfile", [ProfileController::class, "updateProfile"]);
        Route::post("/updateProfileImage", [ProfileController::class, "updateProfileImage"]);
        Route::get("/teacher/classroom", [ClassroomController::class, "getTeacherClassroom"]);
        Route::get("/teacher/classroom/students/{id}",[StudentController::class,"classroomStudents"]);
        Route::get("/teacher/classroom/lessons/{id}", [LessonController::class, "classroomLessons"]);
        Route::get("/teacher/classroom/exams/{id}", [ExamController::class, "classroomExams"]);
        
    });
    // Route::group(['middleware' => ['auth','role.check:admin']], function () {
        // });