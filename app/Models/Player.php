<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Player extends Model
{
    protected $table = 'players';

    protected $primaryKey = 'uuid';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'organization_id',
        'game_customize_revision_id',
        'name',
        'address',
        'phone',
        'email',
        'gender',
        'is_banned',
        'banned_at',
        'created_at',
        'updated_at',
        'book_a_date',
        'birthday',
        'agree_toc',
        'total_score',
    ];

    public static function make(
        int $organization_id,
        int $game_customize_revision_id,
        ?string $name = null,
        ?string $address = null,
        ?string $phone = null,
        ?string $email = null,
        ?string $gender = null,
        ?bool $is_banned = null,
        ?string $banned_at = null,
        ?string $created_at = null,
        ?string $updated_at = null,
        ?string $book_a_date = null,
        ?string $birthday = null,
        ?bool $agree_toc = null,
        ?int $total_score = null,
    ): static {
        $player = new static([
            'organization_id' => $organization_id,
            'game_customize_revision_id' => $game_customize_revision_id,
            'name' => $name,
            'address' => $address,
            'phone' => $phone,
            'email' => $email,
            'gender' => $gender,
            'is_banned' => $is_banned,
            'banned_at' => $banned_at,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
            'book_a_date' => $book_a_date,
            'birthday' => $birthday,
            'agree_toc' => $agree_toc,
            'total_score' => $total_score,
        ]);

        $player->uuid = (string) Str::uuid();

        return $player;
    }
}
