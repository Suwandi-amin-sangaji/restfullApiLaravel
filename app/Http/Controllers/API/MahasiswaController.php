<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  Menampilkan Data API 
    public function index()
    {
        $data = Mahasiswa::all();

        if($data){
            return ApiFormatter::createApi(200, 'data berhasil', $data);
        }else{
            return ApiFormatter::createApi(400, 'Gagal');
        };
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'address' => 'required'
            ]);
            $mahasiswa = Mahasiswa::create([
                'username' => $request->username,
                'address' => $request->address
            ]);
            $data = Mahasiswa::where('id', '=', $mahasiswa->id)->get();
            if ($data) {
                return ApiFormatter::createApi(200, 'Berhasil menambahkan Data', $data);
            }else{
                return ApiFormatter::createApi(400, 'Gagal');
            }

        } catch (Exception $error) {
            return ApiFormatter::createApi(400, $error);
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
        $data = Mahasiswa::where('id', '=', $id)->get();
            if ($data) {
                return ApiFormatter::createApi(200, "Show data id=" .$id, $data);
            }else{
                return ApiFormatter::createApi(400, 'Gagal');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'username' => 'required',
                'address' => 'required'
            ]);

            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->update([
                'username' => $request->username,
                'address' => $request->address
            ]);
            $data = Mahasiswa::where('id', '=', $mahasiswa->id)->get();
            if ($data) {
                return ApiFormatter::createApi(200, 'Berhasil Merubah Data', $data);
            }else{
                return ApiFormatter::createApi(400, 'Gagal');
            }

        } catch (Exception $error) {
            return ApiFormatter::createApi(400, $error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
        
            $data = $mahasiswa->delete();
            if ($data) {
                return ApiFormatter::createApi(200, 'Berhasil menghapus Data');
            }else{
                return ApiFormatter::createApi(400, 'Gagal');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'Gagal');
        }
       
    }
}
