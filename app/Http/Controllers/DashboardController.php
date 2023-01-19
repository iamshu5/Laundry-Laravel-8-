<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(User $user) {
        $jumlahOutlet    = DB::table('outlet')->count();
        $jumlahPaket     = DB::table('paket')->count();
        $jumlahTransaksi = DB::table('transaksi')->count();
        $jumlahDetail    = DB::table('detail_transaksi')->count();
        $jumlahMember    = DB::table('member')->count();
        $jumlahUser      = DB::table('user')->count();

        return view( 'admin/dashboard', [
            'outlet' => $jumlahOutlet,
            'paket' => $jumlahPaket,
            'transaksi' => $jumlahTransaksi,
            'detail_transaksi' => $jumlahDetail,
            'member' => $jumlahMember,
            'user' => $jumlahUser
        ]);
    
    }

    public function indexKasir() {
        $jumlahTransaksi = DB::table('transaksi')->count();
        $jumlahDetail    = DB::table('detail_transaksi')->count();
        $jumlahMember    = DB::table('member')->count();

        return view('/kasir/dashboard', [
            'transaksi' => $jumlahTransaksi,
            'detail_transaksi' => $jumlahDetail,
            'member' => $jumlahMember,
        ]);
    }

    public function indexOwner() {
        $jumlahTransaksi = DB::table('transaksi')->count();
        $jumlahDetail    = DB::table('detail_transaksi')->count();
        $jumlahUser      = DB::table('user')->count();

        return view('/owner/dashboard', [
            'transaksi' => $jumlahTransaksi,
            'detail_transaksi' => $jumlahDetail,
            'user' => $jumlahUser
        ]);
    
    }

}
