<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = auth()->user();

        $options = Option::all();

        return view('admin.option.index', compact('data', 'options'));
    }

    public function index_jenjang_pendidikan(): View
    {
        $data = auth()->user();

        $options = Option::all();

        return view('admin.option.index', compact('data', 'options'));
    }

    public function index_jenjang_fungsional(): View
    {
        $data = auth()->user();

        $options = Option::all();

        return view('admin.option.index', compact('data', 'options'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = auth()->user();

        $questions = Question::all()->pluck('question_text', 'id');

        return view('admin.option.create', compact('data', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'question_id' => 'required',
            'option_text' => 'required',
            'point' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',

        ], [
            'question_id.required' => 'Pertanyaan wajib diisi',
            'option_text.required' => 'Jawaban wajib diisi',
            'point.required' => 'Nilai wajib diisi',
            'point.regex:/^[0-9]+(\.[0-9][0-9]?)?$/' => 'Nilai harus bernilai angka',
        ]);

        $data = [
            'question_id' => $request->input('question_id'),
            'option_text' => $request->input('option_text'),
            'point' => $request->input('point'),
        ];

        Option::create($data);

        return redirect('/admin/options')->with([
            'message' => 'Pertanyaan berhasil dibuat !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Option $option): View
    {
        return view('admin.option.show', compact('option'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $data = auth()->user();

        $questions = Question::all()->pluck('question_text', 'id');

        $options = Option::findOrFail($id);

        return view('admin.option.edit', compact('data', 'options', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'question_id' => 'required',
            'option_text' => 'required',
            'point' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',

        ], [
            'question_id.required' => 'Pertanyaan wajib diisi',
            'option_text.required' => 'Jawaban wajib diisi',
            'point.required' => 'Nilai wajib diisi',
            'point.regex:/^[0-9]+(\.[0-9][0-9]?)?$/' => 'Nilai harus bernilai angka',
        ]);

        $data = [
            'question_id' => $request->input('question_id'),
            'option_text' => $request->input('option_text'),
            'point' => $request->input('point'),
        ];

        $option = Option::findOrFail($id);

        $option->update($data);

        return redirect('/admin/options')->with([
            'message' => 'Pertanyaan berhasil dibuat !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $option = Option::findOrFail($id);

        $option->delete();
        // Alert::success('Data Biaya', 'Berhasil dihapus!!');
        return redirect('/admin/options')->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function massDestroy()
    {
        Option::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
