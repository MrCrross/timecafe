<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 *
 */
class UsersParam extends Model
{
    use HasFactory;

    protected $table = 'users_params';
    public $timestamps = true;
    protected $guarded = [];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_users_params', 'param_id', 'user_id');
    }
}
