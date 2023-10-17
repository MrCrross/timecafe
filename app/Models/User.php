<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fio',
        'login',
        'status',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function params(): Collection
    {
        return $this->belongsToMany(UsersParam::class, 'users_users_params', 'user_id', 'param_id')
            ->pluck('name', 'name');
    }

    public function userParams(): BelongsToMany
    {
        return $this->belongsToMany(UsersParam::class, 'users_users_params', 'user_id', 'param_id');
    }

    public static function restore(int $id, array $fields): int
    {
        return self::query()
            ->updateOrCreate(['id' => $id], $fields)->id;
    }

    public static function deleteByID(int $id): void
    {
        self::query()
            ->where('id', '=', $id)
            ->delete();
    }

    public static function addParam(int $userID, int $paramID): void
    {
        DB::table('users_users_params')
            ->insert([
                'user_id' => $userID,
                'param_id' => $paramID
            ]);
    }

    public static function getParams(int $userID): array
    {
        return DB::table('users_users_params')
            ->select('param_id')
            ->where([
                ['user_id', '=', $userID],
            ])
            ->pluck('param_id')
            ->toArray();
    }

    public static function deleteParams(int $userID, array $paramsIDs): void
    {
        DB::table('users_users_params')
            ->where('user_id', '=', $userID)
            ->whereIn('param_id', $paramsIDs)
            ->delete();
    }
}
