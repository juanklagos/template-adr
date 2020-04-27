<?php

namespace App\Providers;


use ADR\User\Domain\Interfaces\Repositories\UserRepository;
use ADR\User\Domain\Repositories\UserRepositoryEloquent;
use ADR\User\Domain\Interfaces\Repositories\UserRepository;
use ADR\User\Domain\Repositories\UserRepositoryEloquent;
/*HEADER*/

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


                $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
/*BODY*/
    }
}
