<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;

class AdminController extends Controller
{
    public function index()
    {
        $data = DB::table('tb_admin')->get();
        return view('admin/admin', compact('data'));
    }

    public function adminadd(Request $r)
    {
        $filename = time() . "." . $r->foto->getClientOriginalExtension();
        $r->file('foto')->move('img/admin', $filename);
        $nama = $r->nama;
        $username = $r->username;
        $password = $r->password;
        $md5 = md5($r->password);

        $save = DB::table('tb_admin')->insert([
            'admin_nama'        => $nama,
            'admin_username'    => $username,
            'admin_password'    => $password,
            'admin_password_md5'=> $md5,
            'admin_foto'        => $filename
        ]);
        
        if($save == TRUE)
        {
            return redirect('admin')->with('success', 'Data Berhasil Disimpan');
        } else {
            return back()->with('error', 'Data Gagal Disimpan');
        }
    }

    public function adminupdate(Request $r)
    {
        $nama = $r->nama;
        $username = $r->username;
        $password = $r->password;
        $md5 = md5($r->password);

        if($r->file('foto') == NULL){
            $update = DB::table('tb_admin')->where('admin_id', $r->id)->update([
                'admin_nama'        => $nama,
                'admin_username'    => $username,
                'admin_password'    => $password,
                'admin_password_md5'=> $md5
            ]);

        } else {
            $filename = time() . "." . $r->foto->getClientOriginalExtension();
            $r->file('foto')->move('img/admin', $filename);

            $update = DB::table('tb_admin')->where('admin_id', $r->id)->update([
                'admin_nama'        => $nama,
                'admin_username'    => $username,
                'admin_password'    => $password,
                'admin_password_md5'=> $md5,
                'admin_foto'        => $filename
            ]);
        }        
        
        if($update == TRUE)
        {
            return redirect('admin')->with('success', 'Data Berhasil Diperbarui');
        } else {
            return back()->with('error', 'Data Gagal Diperbarui');
        }
    }

    public function admindelete($id)
    {
        $data = DB::table('tb_admin')->where('admin_id', $id)->first();
        $foto = $data->admin_foto;
        File::delete('img/admin/'.$foto);
        $delete = DB::table('tb_admin')->where('admin_id', $id)->delete();

        if($delete == TRUE)
        {
            return redirect('admin')->with('success', 'Data Berhasil Dihapus');
        } else {
            return back()->with('error', 'Data Gagal Dihapus');
        }
    }


}
