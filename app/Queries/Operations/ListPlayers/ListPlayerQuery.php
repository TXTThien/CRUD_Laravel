<?php

namespace App\Queries\Operations\ListPlayers;

class ListPlayerQuery
{
    public function __construct(
        public int $page,
        public int $limit,
        public ?string $search = null,
        public ?string $is_banned = null,
    ) {
        $this->search = trim($this->search);
        $this->is_banned = trim($this->is_banned);
    }
}
