<?php

namespace App\Queries\Operations\ListPlayers;

use App\Models\Player;

class ListPlayerHandler
{
    public function handle(ListPlayerQuery $query): array
    {
        $page = max(1, $query->page);
        $limit = min(max(1, $query->limit), 100);

        $offset = ($page - 1) * $limit;
        $qb = Player::query();

        if (! empty($query->search)) {
            $qb = $qb->where('name', 'like', '%'.$query->search.'%');
        }
        if (! empty($query->is_banned)) {
            $qb = $qb->where('is_banned', 'like', '%'.$query->is_banned.'%');
        }
        $total = $qb->count();

        $players = $qb->offset($offset)->limit($limit)->get();

        return [
            'data' => $players,
            'meta' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $total,
                'last_page' => ceil($total / $limit),
            ],
        ];
    }
}
