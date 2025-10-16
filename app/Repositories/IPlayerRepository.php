<?php

namespace App\Repositories;

interface IPlayerRepository
{
    public function getAllPlayers();

    public function getPlayerById($id);

    public function createPlayer(array $data);

    public function updatePlayer($id, array $data);

    public function deletePlayer($id);
}
