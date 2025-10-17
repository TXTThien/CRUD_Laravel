<?php

namespace App\Repositories;

use App\Models\Player;

interface IPlayerRepository
{
    public function getAllPlayers();

    public function getPlayerById($id): Player;

    public function deletePlayer($id);

    public function save(Player $player): Player;
}
