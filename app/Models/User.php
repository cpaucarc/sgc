<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    protected $fillable = ['name', 'uuid', 'activo', 'codigo', 'email', 'password',];

    protected $hidden = ['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret',];

    protected $casts = ['email_verified_at' => 'datetime',];

    protected $appends = ['profile_photo_url',];

    public function entidades()
    {
        return $this->belongsToMany(Entidad::class, 'entidad_user')
            ->withPivot('id');
    }

    public static function getUserNameById($id)
    {
        return User::where('id', $id)->pluck('name')->first();
    }

    public static function entidades_id($user_id, $entidades_id = null)
    {
        return $entidades_id ? $entidades_id : function ($query) use ($user_id) {
            $query->select('id')->from('entidades')->whereIn('id', function ($query2) use ($user_id) {
                $query2->select('entidad_id')->from('entidad_user')->where('user_id', $user_id);
            });
        };
    }

    public static function facultades_id($user_id, $entidades_id = null)
    {
        $callback = self::entidades_id($user_id, $entidades_id = null);

        return Entidadable::query()
            ->where('entidadable_type', 'App\\Models\\Facultad')
            ->whereIn('entidad_id', $callback)->get()->pluck('entidadable_id');
    }

    public static function escuelas_id($user_id, $entidades_id = null)
    {
        $callback = self::entidades_id($user_id, $entidades_id = null);

        return Entidadable::query()
            ->where('entidadable_type', 'App\\Models\\Escuela')
            ->whereIn('entidad_id', $callback)->get()->pluck('entidadable_id');
    }
}
