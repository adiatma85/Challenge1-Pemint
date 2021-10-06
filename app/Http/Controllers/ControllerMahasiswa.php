<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\http\Response;
use Symfony\Component\Mime\Message;

class ControllerMahasiswa extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return response()->json(['nama' => 'alland'], 400);
    }

    public function listData()
    {
        $mahasiswa = mahasiswa::all();

        return response()->json($mahasiswa, 200);
    }

    public function tambahData(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required',
            'nama' => 'required',
            'telp' => 'required',
        ]);

        if (mahasiswa::create($request->all())) {
            return Response()->json(['Message' => 'Data berhasil ditambahkan'], 200);
        }
        return Response()->json(['Message' => 'Input gagal'], 400);
    }

    public function updateData(Request $request, $id)
    {
        $mahasiswa = mahasiswa::find($id);

        if (!$mahasiswa)
            if (mahasiswa::create($request->all())) {
                return Response()->json(['Message' => 'Data Tidak Ditemukan'], 404);
            }

        $mahasiswa->update($request->all());
        return Response()->json(['Message' => 'Update Berhasil', 'Hasil Update' => $mahasiswa], 200);
    }

    public function deleteData($id)
    {
        $post = mahasiswa::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'data tidak ditemukan',
            ], 404);
        }

        $post->delete();
        return response()->json([
            'message' => 'post has been deleted',
        ], 200);
    }
}
