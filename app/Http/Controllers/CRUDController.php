<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerRequest;
use App\Repositories\IPlayerRepository;

class CRUDController extends Controller
{
    public function getAllPlayers()
    {
        $playerRepository = app(IPlayerRepository::class);

        return response()->json($playerRepository->getAllPlayers());
    }

    public function getPlayerById($id)
    {
        $playerRepository = app(IPlayerRepository::class);

        return response()->json($playerRepository->getPlayerById($id));
    }

    public function newPlayer(PlayerRequest $request)
    {
        $playerRepository = app(IPlayerRepository::class);

        return response()->json($playerRepository->createPlayer($request->validated()));
    }

    public function updatePlayer(PlayerRequest $request, $id)
    {
        $playerRepository = app(IPlayerRepository::class);

        return response()->json($playerRepository->updatePlayer($id, $request->validated()));
    }

    public function deletePlayer($id)
    {
        $playerRepository = app(IPlayerRepository::class);

        return response()->json($playerRepository->deletePlayer($id));
    }
}
