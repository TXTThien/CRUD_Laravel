<?php

namespace App\Providers;

use App\Repositories\IPlayerRepository;
use App\Repositories\PlayerCacheRepository;
use App\Repositories\PlayerRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(IPlayerRepository::class, function ($app) {
            return new PlayerCacheRepository(new PlayerRepository);
        });
    }

    public function boot(): void
    {
        //
    }
}
