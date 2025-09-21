<?php

namespace App\Providers;

// Interfaces
use App\Services\{
    AnnouncementService,
    ProfileService,
    RoleService,
    UserService
};

// Implementaciones
use App\Services\Impl\{
    AnnouncementServiceImpl,
    ProfileServiceImpl,
    RoleServiceImpl,
    UserServiceImpl
};

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(AnnouncementService::class, AnnouncementServiceImpl::class);
        $this->app->bind(ProfileService::class, ProfileServiceImpl::class);
        $this->app->bind(RoleService::class, RoleServiceImpl::class);
        $this->app->bind(UserService::class, UserServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}