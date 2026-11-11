<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Searchable;
    use SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'no_hp',
        'alamat',
        'foto_profil',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /**
     * Data yang dimasukkan ke index pencarian Laravel Scout
     */
    public function toSearchableArray(): array
    {
        return [
            'id'     => (int) $this->id,
            'name'   => $this->name,
            'email'  => $this->email,
            'role'   => $this->role,
            'no_hp'  => $this->no_hp,
        ];
    }

    /**
     * Relasi ke transaksi peminjaman
     */
    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }

    /**
     * Relasi ke log aktivitas
     */
    public function logAktivitas(): HasMany
    {
        return $this->hasMany(LogAktivitas::class);
    }
}