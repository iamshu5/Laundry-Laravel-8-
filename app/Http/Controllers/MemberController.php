<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index(Request $request) {
        $DataMember = Member::when(!empty($request->search_member), function($query) use ($request) {
            $query->where('id_member', 'like', '%' . $request->search_member . '%' )
            ->orWhere('nama_member', 'like', '%' . $request->search_member . '%')
            ->orWhere('alamat', 'like', '%' . $request->search_member . '%')
            ->orWhere('jenis_kelamin', 'like', '%' . $request->search_member . '%')
            ->orWhere('telp', 'like', '%' . $request->search_member . '%');
        })->paginate(10);

        $datauser = Auth::user();
        return view($datauser->posisi . '/member/data-member', ['member' => $DataMember]);
    }

    public function createMember(Request $request) {
        $datauser = Auth::user();

        $rules=[
            'nama_member' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'telp' => 'required',
        ];
        $message=[
            'required' => 'Kolom tidak boleh kosong!',
        ];
        $this->validate($request, $rules, $message);

        $check = Member::where('nama_member', $request->nama_member)->count() > 0;
            if($check) {
                return redirect($datauser->posisi . '/member/data-member')->with('alert', ['bg' => 'warning', 'message' => '< Nama Member >telah terdaftar!']);
            }
        $member = new Member();

        $member->id_member = Str::random(5);
        $member->nama_member = $request->nama_member;
        $member->alamat = $request->alamat;
        $member->jenis_kelamin = $request->jenis_kelamin;
        $member->telp = $request->telp;

        $member->save();
        return redirect($datauser->posisi . '/member/data-member')->with('alert', ['bg' => 'success', 'message' => 'Data berhasil ditambahkan']);
    }

    public function editMember(Member $member, Request $request) {

        $datauser = Auth::user();
        $member->nama_member = $request->nama_member;
        $member->alamat = $request->alamat;
        $member->jenis_kelamin = $request->jenis_kelamin;
        $member->telp = $request->telp;

        $member->save();
        return redirect($datauser->posisi . '/member/data-member')->with('alert', ['bg' => 'success', 'message' => 'Data berhasil di edit!']);
    }

    public function deleteMember(Member $member) {
        $datauser = Auth::user();

        $member->delete();
        return redirect($datauser->posisi . '/member/data-member')->with('alert', ['bg' => 'success', 'message' => 'Data berhasil di Hapus!']);
    }

}
