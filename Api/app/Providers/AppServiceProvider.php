<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryImpl;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\CustomerRepositoryImpl;
use App\Services\Customer\CustomerService;
use App\Services\Customer\CustomerServiceImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);
        $this->app->bind(CustomerService::class, CustomerServiceImpl::class);
        $this->app->bind(CustomerRepository::class, CustomerRepositoryImpl::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
