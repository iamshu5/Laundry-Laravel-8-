<?php

namespace App\Models;

use App\Models\Outlet;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $guarded = ['id_user'];
    public $timestamps = false;
    public $incrementing = false;

    public function outlet() {
        return $this->hasOne(Outlet::class, 'id_outlet', 'id_outlet');
    }
}
