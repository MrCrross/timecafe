<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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

    public static function getByUserID(int $userID): Collection
    {
        return DB::table('users_users_params')
            ->join('users_params', 'users_users_params.param_id', '=', 'users_params.id')
            ->where('user_id', '=', $userID)
            ->pluck('name', 'name');
    }
}
