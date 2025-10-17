<?php

namespace App\Repositories;

use App\Models\PlayerLog;

class PlayerLogRepository implements IPlayerLogRepository
{
    public function getAllPlayerLogs()
    {
        return PlayerLog::all();
    }

    public function getPlayerLogByID($id): PlayerLog
    {
        return PlayerLog::findOrFail($id);
    }

    public function deletePlayerLog($id)
    {
        return PlayerLog::destroy($id);
    }

    public function save(PlayerLog $playerLog): PlayerLog
    {
        $playerLog->save();

        return $playerLog;
    }
}
