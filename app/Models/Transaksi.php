<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $guarded = [ 'id_transaksi'];
    protected $filltable = [ 'id_outlet', 'kode_invoice', 'id_member', 'tgl', 'batas_waktu', 'tgl_bayar', 'biaya_tambahan', 'diskon', 'pajak', 'status', 'dibayar' , 'id_user'];
    public $timestamps = false;
    public $incrementing = false;

    public function outlet() {
        return $this->hasOne(Outlet::class, 'id_outlet', 'id_outlet');
    }

    public function member() {
        return $this->hasOne(Member::class, 'id_member', 'id_member');
    }

    public function user() {
        return $this->hasOne(User::class, 'id_user', 'id_user');
    }

    public function paket() {
        return $this->hasOne(Paket::class, 'id_paket', 'id_paket');
    }

    public function detail() {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi', 'id_transaksi');
    }
    
    public function detailTransaksi()
    {
        return DetailTransaksi::select('detail_transaksi.*', 'paket.harga')
            ->join('paket', 'paket.id_paket', '=', 'detail_transaksi.id_paket')
            ->where('id_transaksi', $this->id_transaksi)
            ->get();
    }
}
