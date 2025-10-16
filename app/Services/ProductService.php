<?php

namespace App\Services;

use App\Models\Player;

class ProductService
{
    public function getAll()
    {
        return Player::all();
    }

    public function getById($id)
    {
        return Player::findOrFail($id);
    }

    public function create(array $data)
    {
        return Player::create($data);
    }

    public function update(array $data, $id)
    {
        $playerUpdate = Player::findOrFail($id);
        $playerUpdate->update($data);

        return $playerUpdate;
    }

    public function delete($id)
    {
        return Player::destroy($id);
    }
}
