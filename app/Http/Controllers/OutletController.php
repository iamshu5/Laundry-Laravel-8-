<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OutletController extends Controller
{
    public function index(Request $request) {
        $DataOutlet = Outlet::when(!empty($request->search_outlet), function($query) use($request){
            $query->where('id_outlet', 'like', '%' . $request->search_outlet . '%')
                    ->orWhere('nama_outlet', 'like', '%' . $request->search_outlet . '%')
                    ->orWhere('alamat', 'like', '%' . $request->search_outlet . '%')
                    ->orWhere('telp', 'like', '%' . $request->search_outlet . '%');
            Outlet::all()->orderBy('id_outlet', 'asc');
        })->paginate(10);

        return view('admin.outlet.data-outlet', ['outlet' => $DataOutlet]);
    }

    public function createOutlet(Request $request) {
        $rules=[
            'nama_outlet' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
        ];
        $message=[
            'required' => 'Kolom tidak boleh kosong!',
        ];
        $this->validate($request, $rules, $message);

        $check = Outlet::where('id_outlet', $request->id_outlet)->count() > 0;
        if($check) {
            return redirect('admin/outlet/data-outlet')->with('alert', ['bg' => 'warning', 'message' => 'Id Outlet sudah tersedia!']);
        }

            $outlet = new Outlet();

            $outlet->id_outlet = Str::random(4);
            $outlet->nama_outlet = $request->nama_outlet;
            $outlet->alamat = $request->alamat;
            $outlet->telp = $request->telp;

            $outlet->save();
            return redirect('admin/outlet/data-outlet')->with('alert', ['bg' => 'success', 'message' => 'Berhasil ditambahkan']);
    }

    public function editOutlet(Outlet $outlet, Request $request) {
        $check = Outlet::where('id_outlet', $request->id_outlet)->count() > 0;
        if($check) {
            return redirect('admin/outlet/data-outlet')->with('alert', ['bg' => 'warning', 'message' => 'Id Outlet sudah tersedia!']);
        }

        $outlet->nama_outlet = $request->nama_outlet;
        $outlet->alamat = $request->alamat;
        $outlet->telp = $request->telp;

        $outlet->save();
        return redirect('admin/outlet/data-outlet')->with('alert', ['bg' => 'success', 'message' => 'Data berhasil di edit!']);
    }

    public function deleteOutlet(Outlet $outlet) {
        $outlet->delete();
        return redirect('admin/outlet/data-outlet')->with('alert', ['bg' => 'success', 'message' => 'Data Berhasil dihapus!']);
    }
}
