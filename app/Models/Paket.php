<?php

namespace App\Models;

use App\Models\Outlet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'paket';
    protected $primaryKey = 'id_paket';
    protected $guarded = [ 'id_paket'];
    protected $filltable = [ 'jenis', 'nama_paket', 'harga'];
    public $timestamps = false;
    public $incrementing = false;

    public function outlet() {
        return $this->hasOne(Outlet::class, 'id_outlet', 'id_outlet');
    }
}
