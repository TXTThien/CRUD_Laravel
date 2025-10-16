<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'players';

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    protected $fillable = [
        'uuid',
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
}
