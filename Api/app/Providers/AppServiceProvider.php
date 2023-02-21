<?php

namespace App\Providers;


use App\Services\Tag\TagService;
use App\Services\Post\PostService;
use App\Services\Tag\TagServiceImpl;
use App\Services\Post\PostServiceImpl;
use App\Repositories\Tag\TagRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Post\PostRepository;
use App\Repositories\User\UserRepository;
use App\Services\Category\CategoryService;
use App\Services\Customer\CustomerService;
use App\Repositories\Tag\TagRepositoryImpl;
use App\Repositories\Post\PostRepositoryImpl;
use App\Repositories\User\UserRepositoryImpl;
use App\Services\Category\CategoryServiceImpl;
use App\Services\Customer\CustomerServiceImpl;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Category\CategoryRepositoryImpl;
use App\Repositories\Customer\CustomerRepositoryImpl;

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
        $this->app->bind(CategoryService::class, CategoryServiceImpl::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryImpl::class);
        $this->app->bind(TagService::class, TagServiceImpl::class);
        $this->app->bind(TagRepository::class, TagRepositoryImpl::class);
        $this->app->bind(PostRepository::class, PostRepositoryImpl::class);
        $this->app->bind(PostService::class, PostServiceImpl::class);
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
