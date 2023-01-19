<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Paket;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index(Request $request) {
        $DataTransaksi = Transaksi::when(!empty($request->search_transaksi), function($query) use ($request) {
            $query->where('id_transaksi', 'like', '%' . $request->search_transaksi . '%')
            ->orWhere('id_outlet', 'like', '%' . $request->search_transaksi . '%')
            ->orWhere('kode_invoice', 'like', '%' . $request->search_transaksi . '%')
            ->orWhere('id_member', 'like', '%' . $request->search_transaksi . '%')
            ->orWhere('tgl', 'like', '%' . $request->search_transaksi . '%')
            ->orWhere('batas_waktu', 'like', '%' . $request->search_transaksi . '%')
            ->orWhere('tgl_bayar', 'like', '%' . $request->search_transaksi . '%')
            ->orWhere('biaya_tambahan', 'like', '%' . $request->search_transaksi . '%')
            ->orWhere('diskon', 'like', '%' . $request->search_transaksi . '%')
            ->orWhere('pajak', 'like', '%' . $request->search_transaksi . '%')
            ->orWhere('status', 'like', '%' . $request->search_transaksi . '%')
            ->orWhere('dibayar', 'like', '%' . $request->search_transaksi . '%')
            ->orWhere('id_user', 'like', '%' . $request->search_transaksi . '%');
        })->paginate(20);

        $dataoutlet = Outlet::all();
        $datamember = Member::all();
        $dataouser = Auth::user();
        $datapaket = Paket::all();

        return view($dataouser->posisi . '/transaksi/data-transaksi', [
            'transaksi' => $DataTransaksi,
            'dataoutlet' => $dataoutlet,
            'datamember' => $datamember,
            'datapaket' => $datapaket,
            'datauser' => $dataouser]);
    }

    public function createTransaksi (Request $request) {
        $transaksi = new Transaksi();
        // dd($request->id_paket);
        $transaksi->id_transaksi = Str::random(8);
        $transaksi->id_outlet = $request->id_outlet;
        $transaksi->kode_invoice = Str::random(9);
        $transaksi->id_member = $request->id_member;
        $transaksi->tgl = date('Y-m-d H:i:s', strtotime($request->tgl));
        $transaksi->batas_waktu = $request->batas_waktu;
        $transaksi->tgl_bayar = date('Y-m-d H:i:s', strtotime($request->tgl_bayar));
        $transaksi->biaya_tambahan = $request->biaya_tambahan;
        $transaksi->diskon = $request->diskon;
        $transaksi->pajak = $request->pajak;
        $transaksi->status = 'baru';
        $transaksi->dibayar = 'belum_dibayar';
        $transaksi->id_user = Auth::user()->id_user;

        $rules=[
            'id_outlet' => 'required',
            'id_member' => 'required',
            'tgl' => 'required',
            'batas_waktu' => 'required',
            'tgl_bayar' => 'required',
            'biaya_tambahan' => 'required',
            'diskon' => 'required',
            'pajak' => 'required',
        ];
        $message=[
            'required' => 'Kolom tidak boleh kosong!',
        ];
        $this->validate($request, $rules, $message);
        $transaksi->save();

        // Mengambil id Detail Transaksi
        foreach($request->id_paket as $i => $idpaket) {
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_paket' => $idpaket,
                'qty' => $request['qty'][$i],
                'keterangan' => $request['keterangan'][$i],
            ]);
        }

        return redirect('admin/transaksi/data-transaksi')->with('alert', ['bg' => 'success', 'message' => 'Data berhasil ditambahkan!']);
    }

    public function editTransaksi (Transaksi $transaksi, Request $request) {
        $transaksi->status = $request->status;
        $transaksi->dibayar = $request->dibayar;
        $transaksi->save();
        return redirect('admin/transaksi/data-transaksi')->with('alert', ['bg' => 'success', 'message' => 'Data berhasil di edit!']);
    }

    public function deleteTransaksi(Transaksi $transaksi) {

        // Hapus transaksi, maka DetailTransaksi akan ikut terhapus
        DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->delete();
        $transaksi->delete();
        return redirect('admin/transaksi/data-transaksi')->with('alert', ['bg' => 'success', 'message' => 'Data berhasil dihapus!']);
    }

    public function DetailTransaksi(Transaksi $transaksi) {
        $transaksi->outlet;
        $transaksi->member;
        $transaksi->user;

        $totalHargaPaket = $transaksi->detailTransaksi()->sum('harga');
        $aPajak = (($totalHargaPaket / 1000) * $transaksi->pajak); // Menghitung Pajak
        $aDiskon = (($totalHargaPaket / 1000) * $transaksi->diskon); // Mengitung diskon
        $totalBayar = $totalHargaPaket + $transaksi->biaya_tambahan + $transaksi->pajak - $transaksi->diskon; // Total Harga Bayar

        return view(Auth::user()->posisi . '/transaksi/detail-transaksi', [
            'transaksi' => $transaksi, 
            'pajak' => $aPajak, 
            'diskon' => $aDiskon, 
            'total_bayar' => $totalBayar, 
            'total_harga' => $totalHargaPaket]);
    }
}
