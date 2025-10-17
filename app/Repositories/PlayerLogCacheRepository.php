<?php

namespace App\Repositories;

use App\Models\PlayerLog;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Support\Facades\Cache;

class PlayerLogCacheRepository implements IPlayerLogRepository
{
    protected CacheRepository $cache;

    public function __construct(
        protected PlayerLogRepository $playerLogRepository
    ) {
        $this->cache = Cache::driver('redis');
    }

    protected function getKey(string $id): string
    {
        $template = config('cache_keys.player_log.find');

        return str_replace('{id}', $id, $template);
    }

    public function getAllPlayerLogs()
    {
        $key = config('cache_keys.player_log.all');

        return $this->cache->remember($key, 60 * 60 * 12, function () {
            return $this->playerLogRepository->getAllPlayerLogs();
        });
    }

    public function getPlayerLogByID($id): PlayerLog
    {
        $key = $this->getKey($id);

        return $this->cache->remember($key, 60 * 60 * 12, function () use ($id) {
            return $this->playerLogRepository->getPlayerLogByID($id);
        });
    }

    public function deletePlayerLog($id)
    {
        $this->playerLogRepository->deletePlayerLog($id);
        $this->cache->forget($this->getKey($id));

        $this->cache->forget(config('cache_keys.player_log.all'));
    }

    public function save(PlayerLog $playerLog): PlayerLog
    {
        $saved = $this->playerLogRepository->save($playerLog);
        $key = $this->getKey($playerLog->uuid);
        $this->cache->put($key, $saved, 60 * 60 * 12);
        $this->cache->forget('all_player_log');

        return $saved;
    }
}
