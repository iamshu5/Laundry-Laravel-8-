<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $table = 'outlet';
    protected $primaryKey = 'id_outlet';
    protected $guarded = [ 'id_outlet'];
    protected $filltable = [ 'nama_outlet', 'alamat', 'telp'];
    public $timestamps = false;
    public $incrementing = false;
}
