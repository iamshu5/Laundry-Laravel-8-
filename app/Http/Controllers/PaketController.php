<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Outlet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaketController extends Controller
{
    public function index(Request $request) {
        $DataPaket = Paket::when(!empty($request->search_paket), function($query) use($request) {
            $query->where('id_paket', 'like', '%' . $request->search_paket . '%')
            ->orWhere('id_outlet', 'like', '%' . $request->search_paket . '%')
            ->orWhere('jenis', 'like', '%' . $request->search_paket . '%')
            ->orWhere('nama_paket', 'like', '%' . $request->search_paket . '%')
            ->orWhere('harga', 'like', '%' . $request->search_paket . '%');
        })->paginate(10);

        $dataoutlet = Outlet::all();
        return view('admin/paket/data-paket', ['paket' => $DataPaket, 'dataoutlet' => $dataoutlet] );
    }

    public function createPaket(Request $request) {
        $paket = new Paket();

        $paket->id_paket = Str::random(6);
        $paket->id_outlet = $request->id_outlet;
        $paket->jenis = $request->jenis;
        $paket->nama_paket = $request->nama_paket;
        $paket->harga = $request->harga;

        $rules=[
            'id_outlet' => 'required',
            'jenis' => 'required',
            'nama_paket' => 'required',
            'harga' => 'required',
        ];
        $message=[
            'required' => 'Kolom ini tidak boleh kosong!',
        ];
        $this->validate($request, $rules, $message);

        $paket->save();
        return redirect('admin/paket/data-paket')->with('alert', ['bg' => 'success', 'message' => 'Data berhasil ditambahkan!']);
    }

    public function editPaket(Paket $paket, Request $request) {

        $paket->id_outlet = $request->id_outlet;
        $paket->jenis = $request->jenis;
        $paket->nama_paket = $request->nama_paket;
        $paket->harga = $request->harga;

        $paket->save();
        return redirect('admin/paket/data-paket')->with('alert', ['bg' => 'success', 'message' => 'Data berhasil di edit!']);
    }

    public function deletePaket(Paket $paket) {

        $paket->delete();
        return redirect('admin/paket/data-paket');
    }
}
