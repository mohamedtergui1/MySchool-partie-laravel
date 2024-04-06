<?php

namespace App\Providers;

 
use App\Repositories\ClassroomRepository;
use App\Repositories\ClassroomRepositoryInterface;
use App\Repositories\GradeRepository;
use App\Repositories\GradeRepositoryInterface;

use App\Repositories\PromoRepository;
use App\Repositories\PromoRepositoryInterface;
use App\Repositories\LossonsRepository;
use App\Repositories\LossonsRepositoryInterface;
use App\Repositories\ScholasticyearRepository;
use App\Repositories\ScholasticyearRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
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
        $this->app->bind(LossonsRepositoryInterface::class, LossonsRepository::class);
        $this->app->bind(PromoRepositoryInterface::class, PromoRepository::class);
        $this->app->bind(GradeRepositoryInterface::class, GradeRepository::class);




    }
    

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
