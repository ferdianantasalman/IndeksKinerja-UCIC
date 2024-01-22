<?php

namespace App\Http\Controllers;

use App\Models\JenjangFungsional;
use Illuminate\Http\Request;

class JenjangFungsionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = auth()->user();

        $jenjang_fungsional = JenjangFungsional::where('user_id', '=', $data['id'])->get();

        return view('dosen.jenjang_fungsional.index', compact('data', 'jenjang_fungsional'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = auth()->user();

        return view('dosen.jenjang_fungsional.create', compact('data'));
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
    public function show(JenjangFungsional $jenjangFungsional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenjangFungsional $jenjangFungsional)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenjangFungsional $jenjangFungsional)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenjangFungsional $jenjangFungsional)
    {
        //
    }
}
