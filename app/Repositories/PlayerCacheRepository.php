<?php

namespace App\Repositories;

use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Support\Facades\Cache;

class PlayerCacheRepository implements IPlayerRepository
{
    protected CacheRepository $cache;

    public function __construct(
        protected PlayerRepository $playerRepository
    ) {
        $this->cache = Cache::driver('redis');
    }

    protected function getKey(string $id): string
    {
        $template = config('cache_keys.player.find');

        return str_replace('{id}', $id, $template);
    }

    public function getAllPlayers()
    {
        return $this->cache->remember('all_players', 60 * 60 * 12, function () {
            return $this->playerRepository->getAllPlayers();
        });
    }

    public function getPlayerById($id)
    {
        $key = $this->getKey($id);

        return $this->cache->remember($key, 60 * 60 * 12, function () use ($id) {
            return $this->playerRepository->getPlayerById($id);
        });
    }

    public function createPlayer(array $data)
    {
        $player = $this->playerRepository->createPlayer($data);
        $this->cache->put($this->getKey($player->uuid), $player, 60 * 60 * 12);

        $this->cache->forget('all_players');

        return $player;
    }

    public function updatePlayer($id, array $data)
    {
        $player = $this->playerRepository->updatePlayer($id, $data);
        $this->cache->put($this->getKey($id), $player, 60 * 60 * 12);

        $this->cache->forget('all_players');

        return $player;
    }

    public function deletePlayer($id): void
    {
        $this->playerRepository->deletePlayer($id);
        $this->cache->forget($this->getKey($id));

        $this->cache->forget('all_players');
    }
}
