<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerRequest;
use App\Queries\Operations\ListPlayers\ListPlayerHandler;
use App\Queries\Operations\ListPlayers\ListPlayerQuery;
use App\Repositories\IPlayerRepository;
use App\Services\PlayerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CRUDController extends Controller
{
    protected $playerRepository;

    protected ListPlayerHandler $handler;

    public function __construct(ListPlayerHandler $handler)
    {
        $this->handler = $handler;
    }

    public function index(Request $request): JsonResponse
    {
        $query = new ListPlayerQuery(
            page: (int) $request->query('page', 1),
            limit: (int) $request->query('limit', 100),
            search: $request->query('search'),
            is_banned: $request->query('is_banned')
        );

        $result = $this->handler->handle($query);

        return response()->json($result);
    }

    public function getAllPlayers(): JsonResponse
    {
        $playerRepository = app(IPlayerRepository::class);

        return response()->json($playerRepository->getAllPlayers());
    }

    public function getPlayerById($id): JsonResponse
    {
        $playerRepository = app(IPlayerRepository::class);

        return response()->json($playerRepository->getPlayerById($id));
    }

    public function newPlayer(PlayerRequest $request): JsonResponse
    {
        $playerService = app(PlayerService::class);
        $player = $playerService->newPlayer($request);

        return response()->json($player, 201);
    }

    public function updatePlayer(PlayerRequest $request, string $uuid): JsonResponse
    {
        $playerService = app(PlayerService::class);
        $player = $playerService->updatePlayer($request, $uuid);

        return response()->json($player);
    }

    public function deletePlayer($id): JsonResponse
    {
        $playerRepository = app(IPlayerRepository::class);

        return response()->json($playerRepository->deletePlayer($id));
    }

    public function createPlayerWithLog(PlayerRequest $playerRequest): JsonResponse
    {
        $playerService = app(PlayerService::class);
        $player = $playerService->createPlayerWithLog($playerRequest);

        return response()->json($player);
    }
}
