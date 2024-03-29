<?php

namespace App\Http\Controllers;

use App\Models\JenjangPendidikan;
use Illuminate\Http\Request;

class JenjangPendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = auth()->user();
        $jenjang_pendidikan = JenjangPendidikan::where('user_id', '=', $data['id'])->get();

        return view('dosen.jenjang_pendidikan.index', compact('data', 'jenjang_pendidikan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = auth()->user();

        return view('dosen.jenjang_pendidikan.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JenjangPendidikan $jenjangPendidikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenjangPendidikan $jenjangPendidikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenjangPendidikan $jenjangPendidikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenjangPendidikan $jenjangPendidikan)
    {
        //
    }
}
