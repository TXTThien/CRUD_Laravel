<?php

namespace App\Providers;

use App\Repositories\IPlayerLogRepository;
use App\Repositories\IPlayerRepository;
use App\Repositories\PlayerCacheRepository;
use App\Repositories\PlayerLogCacheRepository;
use App\Repositories\PlayerLogRepository;
use App\Repositories\PlayerRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(IPlayerRepository::class, function ($app) {
            return new PlayerCacheRepository(new PlayerRepository);
        });
        $this->app->bind(IPlayerLogRepository::class, function ($app) {
            return new PlayerLogCacheRepository(new PlayerLogRepository);
        });

    }

    public function boot(): void
    {
        //
    }
}
