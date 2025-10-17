<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerLog extends Model
{
    protected $table = 'player_logs';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'player_uuid',
        'action',
        'description',
        'created_at',
        'updated_at',
    ];

    public static function make(
        string $player_uuid,
        string $action,
        string $description,
        string $created_at,
        string $updated_at
    ): static {
        return new static([
            'player_uuid' => $player_uuid,
            'action' => $action,
            'description' => $description,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);
    }
}
