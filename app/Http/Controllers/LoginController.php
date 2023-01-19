<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function userLogin() {
        if(Auth::check()) {
            return redirect('login');
        }
        $dataoutlet = Outlet::all();
        return view('login', ['dataoutlet' => $dataoutlet] );
    }

    public function userLogout() {
        Auth::logout();
        return redirect('login')->with('alert', ['bg' =>  'success', 'message' => 'Dadah, istirahat dulu']);
    }

    public function logProses(Request $request) {
        // Validasi Jika Admin dan Kasir tidak memilih Outlet
        if(in_array($request->login_sebagai, ['admin', 'kasir']) && empty($request->id_outlet)) {
            return redirect('login')->with('alert', ['bg' => 'danger', 'message' => 'Outlet wajib diisi!']);
        }

        $user = User::where('username', $request->username)->where('posisi', $request->login_sebagai)
                ->when(!empty($request->id_outlet), function($query) use($request) {
                    $query->where('id_outlet', $request->id_outlet);
                })->first();

        if($user === NULL || !Hash::check($request->password, $user->password) )
        {
            return redirect('login')->with('alert', ['bg' => 'danger', 'message' => 'Username atau Password tidak terdaftar!']);
        }

        Auth::login($user);
        return redirect($user->posisi . '/dashboard');
    }
}
