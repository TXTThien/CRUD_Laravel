<?php

namespace App\Repositories;

use App\Models\Player;
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
        $key = config('cache_keys.player.all');

        return $this->cache->remember($key, 60 * 60 * 12, function () {
            return $this->playerRepository->getAllPlayers();
        });
    }

    public function getPlayerById($id): Player
    {
        $key = $this->getKey($id);

        return $this->cache->remember($key, 60 * 60 * 12, function () use ($id) {
            return $this->playerRepository->getPlayerById($id);
        });
    }

    public function deletePlayer($id): void
    {

        $this->playerRepository->deletePlayer($id);
        $this->cache->forget($this->getKey($id));

        $this->cache->forget(config('cache_keys.player.all'));
    }

    public function save(Player $player): Player
    {
        $saved = $this->playerRepository->save($player);
        $key = $this->getKey($player->uuid);
        $this->cache->put($key, $saved, 60 * 60 * 12);
        $this->cache->forget('all_players');

        return $saved;
    }
}
