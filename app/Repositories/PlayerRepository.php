<?php

namespace App\Repositories;

use App\Models\Player;

class PlayerRepository implements IPlayerRepository
{
    public function getAllPlayers()
    {
        return Player::all();
    }

    public function getPlayerById($id)
    {
        return Player::findOrFail($id);
    }

    public function createPlayer(array $data)
    {
        return Player::create($data);
    }

    public function updatePlayer($id, array $data)
    {
        $player = Player::findOrFail($id);
        $player->update($data);

        return $player;
    }

    public function deletePlayer($id)
    {
        return Player::destroy($id);
    }
}
