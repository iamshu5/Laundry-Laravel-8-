<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Outlet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request) {

        $DataUser = User::when(!empty($request->search_user), function($query) use ($request) {
            $query->where('id_user', 'like', '%' . $request->search_user . '%')
            // ->orWhere('id_outlet', 'like', '%' . $request->id_outlet . '%')
            ->orWhere('username', 'like', '%' . $request->search_user . '%')
            ->orWhere('nama_user', 'like', '%' . $request->search_user . '%')
            ->orWhere('posisi', 'like', '%' . $request->search_user . '%');
        })->paginate(10);

        $dataoutlet = Outlet::all('id_outlet', 'nama_outlet');

        return view('admin/user/data-user', ['user' => $DataUser, 'dataoutlet' => $dataoutlet]);
    }

    public function createUser(Request $request) {
        $user = new User();

        $check = User::where('username', $request->username)->count() > 0;
        if($check) {
            return redirect($user->posisi . '/user/data-user')->with('alert', ['bg' => 'warning', 'message' => 'Username telah terdaftar!']);
        }

        $user->id_user = Str::random(5);
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->nama_user = $request->nama_user;
        $user->id_outlet = $request->id_outlet;
        $user->posisi = $request->posisi;

        $rules=[
            'username' => 'required',
            'password' => 'required',
            'nama_user' => 'required',
            'id_outlet' => 'required',
            'posisi' => 'required',
        ];
        $message=[
            'required' => 'Kolom tidak boleh kosong!'
        ];
        $this->validate($request, $rules, $message);

        $user->save();
        return redirect($user->posisi . '/user/data-user')->with('alert', ['bg' => 'success', 'message' => 'Data berhasil ditambahkan!' ]);
    }

    public function editUser(User $user, Request $request) {

        $user->username = $request->username;
        $user->password = !empty($request->password) ? Hash::make($request->password) : $user->password;
        $user->nama_user = $request->nama_user;
        $user->id_outlet = $request->id_outlet;
        $user->posisi = $request->posisi;

        $user->save();
        return redirect($user->posisi . '/user/data-user')->with('alert', ['bg' => 'success', 'message' => 'Data berhasil di edit!']);
    }

    public function deleteUser(User $user) {
        $user->delete();
        return redirect($user->posisi . '/user/data-user')->with('alert', ['bg' => 'success', 'message' => 'Data berhasil di hapus!' ]);
    }
}
