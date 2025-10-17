<?php

namespace App\Repositories;

use App\Models\Player;

class PlayerRepository implements IPlayerRepository
{
    public function getAllPlayers()
    {
        return Player::all();
    }

    public function getPlayerById($id): Player
    {
        return Player::findOrFail($id);
    }

    public function deletePlayer($id)
    {
        return Player::destroy($id);
    }

    public function save(Player $player): Player
    {
        $player->save();

        return $player;
    }
}
