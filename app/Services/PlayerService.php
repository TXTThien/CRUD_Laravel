<?php

namespace App\Services;

use App\Http\Requests\PlayerRequest;
use App\Models\Player;
use App\Models\PlayerLog;
use App\Repositories\IPlayerRepository;
use App\Repositories\PlayerLogRepository;
use App\Repositories\PlayerRepository;
use Illuminate\Support\Facades\DB;

class PlayerService
{
    public function __construct(
        protected PlayerRepository $playerRepository,
        protected PlayerLogRepository $playerLogRepository
    ) {}

    public function newPlayer(PlayerRequest $request): Player
    {
        $data = $request->validated();
        $player = Player::make(
            $data['organization_id'],
            $data['game_customize_revision_id'],
            $data['name'],
            $data['address'],
            $data['phone'],
            $data['email'],
            $data['gender'],
            $data['is_banned'],
            $data['banned_at'],
            $data['created_at'],
            $data['updated_at'],
            $data['book_a_date'],
            $data['birthday'],
            $data['agree_toc'],
            $data['total_score'],
        );

        $this->playerRepository->save($player);

        return $player;
    }

    public function updatePlayer(PlayerRequest $request, string $uuid): Player
    {
        $data = $request->validated();

        $playerRepository = app(IPlayerRepository::class);
        $this->playerRepository = $playerRepository;
        $player = $this->playerRepository->getPlayerById($uuid);

        foreach ($data as $key => $value) {
            $player->$key = $value;
        }

        $this->playerRepository->save($player);

        return $player;
    }

    public function createPlayerWithLog(PlayerRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $player = $this->newPlayer($request);

            $playerLog = new PlayerLog([
                'player_uuid' => $player->uuid,
                'action' => 'CREATE',
                'description' => "Tạo mới player {$player->name} thành công",
                'created_at' => now()->toDateTimeString(),
            ]);

            $this->playerLogRepository->save($playerLog);

            return $player;
        });
    }
}
