<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory,HasUuids;

    // protected $fillable = [ 'name','email','password', ];
    protected $guarded = [];

    protected $hidden = ['password', 'remember_token'];

    //  * The attributes that should be cast.
    //  * @var array<string, string>

    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed'];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
