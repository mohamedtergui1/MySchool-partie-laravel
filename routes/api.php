<?php

use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\PromoController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\AnnonceController;
use App\Http\Controllers\Api\LessonController;



use App\Http\Middleware\RoleCheck;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;

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




Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => RoleCheck::class . ':admin'], function () {

        Route::apiResource("admin/students", StudentController::class);
        Route::apiResource("admin/employees", EmployeeController::class);
        Route::apiResource("admin/annonces", AnnonceController::class);
        Route::get("admin/allstudents", [StudentController::class, 'getStudents']);
        Route::post("/admin/students/changeImage/{id}", [StudentController::class, 'changeImage']);
        Route::get("admin/allteachers", [EmployeeController::class, 'getTeachers']);
        Route::apiResource("admin/promos", PromoController::class);
        Route::get("admin/allpromos", [PromoController::class, 'indexAll']);
        Route::apiResource("admin/grades", GradeController::class);
        Route::get("admin/allgrades", [GradeController::class, 'indexAll']);
        Route::apiResource("admin/classrooms", ClassroomController::class);
        Route::get("/admin/getAvailableStudents/{id}", [StudentController::class, "getAvailableStudents"]);
        Route::put("/admin/syncStudents/{id}", [ClassroomController::class, "syncStudents"]);
        Route::apiResource("/teacher/Lessons", LessonController::class);
        Route::get("/classrooms/lesson", [ClassroomController::class, "getClassroomsForLesson"]);

    });
});


// Route::group(['middleware' => ['auth','role.check:admin']], function () {
// });