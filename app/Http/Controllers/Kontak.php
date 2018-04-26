<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelKontak;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ModelKontak::all();
    //    return view('kontak',compact('data')); >>> ini untuk biasa tanpa restful
        
        //UNTUK RESTFUL API (kode dibawah)
        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
        $res['message'] = "Success!";
        $res['values'] = $data;
        return response($res);
    }
    else{
        $res['message'] = "Empty!";
        return response($res);
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
   {
       return view('kontak_create');
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

   //     //UNTUK BIASA (KODE DEIBAWAH INI PADA METHOD STORE)
   //  public function store(Request $request)
   // {
   //     $data = new ModelKontak();
   //     $data->nama = $request->nama;
   //     $data->email = $request->email;
   //     $data->nohp = $request->nohp;
   //     $data->alamat = $request->alamat;
   //     $data->save();
   //     return redirect()->route('kontak.index')->with('alert-success','Berhasil Menambahkan Data!');
   // }

   //UNTUK WEBSERVICE RESTFULL (KODE DEIBAWAH INI PADA METHOD STORE)
   public function store(Request $request)
{
    $nama = $request->input('nama');
    $email = $request->input('email');
    $nohp = $request->input('nohp');
    $alamat = $request->input('alamat');

    $data = new \App\ModelKontak();
    $data->nama = $nama;
    $data->email = $email;
    $data->nohp = $nohp;
    $data->alamat = $alamat;

    if($data->save()){
        $res['message'] = "Success!";
        $res['value'] = "$data";
        return response($res);
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = \App\ModelKontak::where('id',$id)->get();

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
            $res['message'] = "Success!";
            $res['values'] = $data;
            return response($res);
        }
        else{
            $res['message'] = "Failed!";
            return response($res);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit($id)
    {
        $data = ModelKontak::where('id',$id)->get();

        return view('kontak_edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

// //INI FUNGSI UPDATE TIDAK UNTUK RESTFUL API
//    public function update(Request $request, $id)
//     {
//         $data = ModelKontak::where('id',$id)->first();
//         $data->nama = $request->nama;
//         $data->email = $request->email;
//         $data->nohp = $request->nohp;
//         $data->alamat = $request->alamat;
//         $data->save();
//         return redirect()->route('kontak.index')->with('alert-success','Data berhasil diubah!');
//     }


//INI FUNGSI UPDATE UNTUK RESTFUL API
    public function update(Request $request, $id)
    {
        //
        $nama = $request->input('nama');
        $email = $request->input('email');
        $nohp = $request->input('nohp');
        $alamat = $request->input('alamat');

        $data = \App\ModelKontak::where('id',$id)->first();
        $data->nama = $nama;
        $data->email = $email;
        $data->nohp = $nohp;
        $data->alamat = $alamat;

        if($data->save()){
            $res['message'] = "Success!";
            $res['value'] = "$data";
            return response($res);
        }
        else{
            $res['message'] = "Failed!";
            return response($res);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // //DESTROY UNTUK BIASA ATAU TIDAK UNTUK RESTFULL API
    // public function destroy($id)
    // {
    //     $data = ModelKontak::where('id',$id)->first();
    //     $data->delete();
    //     return redirect()->route('kontak.index')->with('alert-success','Data berhasi dihapus!');
    // }

    //DESTROY UNTUK RESTFUL API
    public function destroy($id)
    {
        $data = \App\ModelKontak::where('id',$id)->first();

        if($data->delete()){
            $res['message'] = "Success!";
            $res['value'] = "$data";
            return response($res);
        }
        else{
            $res['message'] = "Failed!";
            return response($res);
        }
    }
}
