<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id_detail';
    protected $guarded = [ 'id_detail'];
    protected $filltable = [ 'id_transaksi', 'id_paket', 'qty', 'keterangan'];
    public $timestamps = false;
    public $incrementing = false;

    public function transaksi() {
        return $this->hasOne(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }
    public function paket() {
        return $this->hasOne(Paket::class, 'id_paket', 'id_paket');
    }

}
