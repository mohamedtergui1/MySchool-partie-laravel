<?php

namespace App\Providers;

 
use App\Repositories\ClassroomRepository;
use App\Repositories\ClassroomRepositoryInterface;
use App\Repositories\GradeRepository;
use App\Repositories\GradeRepositoryInterface;

use App\Repositories\PromoRepository;
use App\Repositories\PromoRepositoryInterface;
use App\Repositories\AnnonceRepository; 
use App\Repositories\AnnonceRepositoryInterface; 
use App\Repositories\LessonRepository;
use App\Repositories\LessonRepositoryInterface;
use App\Repositories\ScholasticyearRepository;
use App\Repositories\ScholasticyearRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ExamRepository;
use App\Repositories\ExamRepositoryInterface;
use App\Repositories\ResultRepository; 
use App\Repositories\ResultRepositoryInterface;



use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider 
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // 
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ClassroomRepositoryInterface::class, ClassroomRepository::class);
        $this->app->bind(ScholasticyearRepositoryInterface::class, ScholasticyearRepository::class);
        $this->app->bind(LessonRepositoryInterface::class, LessonRepository::class);
        $this->app->bind(PromoRepositoryInterface::class, PromoRepository::class);
        $this->app->bind(GradeRepositoryInterface::class, GradeRepository::class);
        $this->app->bind(AnnonceRepositoryInterface::class, AnnonceRepository::class);
        $this->app->bind(ExamRepositoryInterface::class, ExamRepository::class);
        $this->app->bind(ResultRepositoryInterface::class, ResultRepository::class);


    }
    

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
