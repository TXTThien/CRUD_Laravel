<?php

namespace App\Repositories;

use App\Models\PlayerLog;

interface IPlayerLogRepository
{
    public function getAllPlayerLogs();

    public function getPlayerLogByID($id): PlayerLog;

    public function deletePlayerLog($id);

    public function save(PlayerLog $playerLog): PlayerLog;
}
