<?php

namespace App\Http\Controllers;

use App\Models\BobotNilai;
use Illuminate\Http\Request;

class BobotNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = auth()->user();
        $bobot_nilai = BobotNilai::orderBy('id', 'asc')->get();

        return view('admin.bobot_nilai.index', compact('bobot_nilai', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = auth()->user();

        return view('admin.bobot_nilai.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'point' => 'required|integer',
        ], [
            'category.required' => 'Kategori wajib diisi',
            'name.required' => 'Nama wajib diisi',
            'point.required' => 'Nilai wajib diisi',
            'point.integer' => 'Nilai wajib diisi dengan angka',
        ]);


        $data = [
            'category' => $request->input('category'),
            'name' => $request->input('name'),
            'point' => $request->input('point'),
        ];

        BobotNilai::create($data);

        return redirect('/admin/bobotnilai');
    }

    /**
     * Display the specified resource.
     */
    public function show(BobotNilai $bobotNilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd($bobotNilai);
        $data = auth()->user();
        $bobotNilai = BobotNilai::findOrFail($id);

        // $bobot_nilai = $bobotNilai;
        // $id = $bobotNilai->id;

        return view(
            'admin.bobot_nilai.edit',
            [
                'data' => $data,
                'bobotNilai' => $bobotNilai
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'point' => 'required|integer',
        ], [
            'category.required' => 'Kategori wajib diisi',
            'name.required' => 'Nama wajib diisi',
            'point.required' => 'Nilai wajib diisi',
            'point.integer' => 'Nilai wajib diisi dengan angka',
        ]);


        $data = [
            'category' => $request->input('category'),
            'name' => $request->input('name'),
            'point' => $request->input('point'),
        ];

        $bobotNilai = BobotNilai::findOrFail($id);

        $bobotNilai->update($data);

        return redirect('/admin/bobotnilai');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bobotNilai = BobotNilai::findOrFail($id);

        $bobotNilai->delete();
        // Alert::success('Data Biaya', 'Berhasil dihapus!!');
        return redirect('/admin/bobotnilai');
    }
}
