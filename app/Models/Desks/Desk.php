<?php

namespace App\Models\Desks;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Desk extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'desks';
    public $timestamps = true;
    protected $guarded = [];

    public function reservation(): HasMany
    {
        return $this->hasMany(DesksReservation::class, 'id', 'desk_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(DesksOrder::class, 'id', 'desk_id');
    }

    public function waiters(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'desks_waiters', 'desk_id', 'user_id');
    }
}
