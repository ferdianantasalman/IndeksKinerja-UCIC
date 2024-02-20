<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        $options = Option::where('category_id', '=', 1)->get();

        return view('admin.jenjang_pendidikan.option.index', compact('data', 'options'));
    }

    public function index_jenjang_fungsional(): View
    {
        $data = auth()->user();

        $options = Option::where('category_id', '=', 2)->get();

        return view('admin.jenjang_fungsional.option.index', compact('data', 'options'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = auth()->user();

        $categories = Category::all()->pluck('name', 'id');

        $questions = Question::all()->pluck('question_text', 'id');

        // dd($questions);

        return view('admin.option.create', compact('data', 'questions', 'categories'));
    }

    public function create_jenjang_pendidikan(): View
    {
        $data = auth()->user();

        $categories = Category::where('id', '=', 1)->pluck('name', 'id');

        $questions = Question::where('category_id', '=', 1)->pluck('question_text', 'id');

        return view('admin.jenjang_pendidikan.option.create', compact('data', 'questions', 'categories'));
    }

    public function create_jenjang_fungsional(): View
    {
        $data = auth()->user();

        $categories = Category::where('id', '=', 2)->pluck('name', 'id');

        $questions = Question::where('category_id', '=', 2)->pluck('question_text', 'id');

        return view('admin.jenjang_fungsional.option.create', compact('data', 'questions', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required',
            'question_id' => 'required',
            'option_text' => 'required',
            'point' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',

        ], [
            'category_id.required' => 'Pertanyaan wajib diisi',
            'question_id.required' => 'Pertanyaan wajib diisi',
            'option_text.required' => 'Jawaban wajib diisi',
            'point.required' => 'Nilai wajib diisi',
            'point.regex:/^[0-9]+(\.[0-9][0-9]?)?$/' => 'Nilai harus bernilai angka',
        ]);

        $data = [
            'category_id' => $request->input('category_id'),
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

    public function store_jenjang_pendidikan(Request $request): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required',
            'question_id' => 'required',
            'option_text' => 'required',
            'point' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',

        ], [
            'question_id.required' => 'Pertanyaan wajib diisi',
            'question_id.required' => 'Pertanyaan wajib diisi',
            'option_text.required' => 'Jawaban wajib diisi',
            'point.required' => 'Nilai wajib diisi',
            'point.regex:/^[0-9]+(\.[0-9][0-9]?)?$/' => 'Nilai harus bernilai angka',
        ]);

        $data = [
            'category_id' => $request->input('category_id'),
            'question_id' => $request->input('question_id'),
            'option_text' => $request->input('option_text'),
            'point' => $request->input('point'),
        ];

        Option::create($data);

        return redirect('/admin/jenjang_pendidikan/options')->with([
            'message' => 'Pertanyaan berhasil dibuat !',
            'alert-type' => 'success'
        ]);
    }

    public function store_jenjang_fungsional(Request $request): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required',
            'question_id' => 'required',
            'option_text' => 'required',
            'point' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',

        ], [
            'question_id.required' => 'Pertanyaan wajib diisi',
            'question_id.required' => 'Pertanyaan wajib diisi',
            'option_text.required' => 'Jawaban wajib diisi',
            'point.required' => 'Nilai wajib diisi',
            'point.regex:/^[0-9]+(\.[0-9][0-9]?)?$/' => 'Nilai harus bernilai angka',
        ]);

        $data = [
            'category_id' => $request->input('category_id'),
            'question_id' => $request->input('question_id'),
            'option_text' => $request->input('option_text'),
            'point' => $request->input('point'),
        ];

        Option::create($data);

        return redirect('/admin/jenjang_fungsional/options')->with([
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

        $categories = Category::all()->pluck('name', 'id');

        $questions = Question::all()->pluck('question_text', 'id');

        $options = Option::findOrFail($id);

        return view('admin.option.edit', compact('data', 'options', 'questions', 'categories'));
    }

    public function edit_jenjang_pendidikan($id): View
    {
        $data = auth()->user();

        $categories = Category::where('id', '=', 1)->pluck('name', 'id');

        $questions = Question::where('category_id', '=', 1)->pluck('question_text', 'id');

        $options = Option::findOrFail($id);

        return view('admin.jenjang_pendidikan.option.edit', compact('data', 'options', 'questions', 'categories'));
    }

    public function edit_jenjang_fungsional($id): View
    {
        $data = auth()->user();

        $categories = Category::where('id', '=', 2)->pluck('name', 'id');

        $questions = Question::where('category_id', '=', 2)->pluck('question_text', 'id');

        $options = Option::findOrFail($id);

        return view('admin.jenjang_fungsional.option.edit', compact('data', 'options', 'questions', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required',
            'question_id' => 'required',
            'option_text' => 'required',
            'point' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',

        ], [
            'category_id.required' => 'Kategori wajib diisi',
            'question_id.required' => 'Pertanyaan wajib diisi',
            'option_text.required' => 'Jawaban wajib diisi',
            'point.required' => 'Nilai wajib diisi',
            'point.regex:/^[0-9]+(\.[0-9][0-9]?)?$/' => 'Nilai harus bernilai angka',
        ]);

        $data = [
            'category_id' => $request->input('category_id'),
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

    public function update_jenjang_pendidikan(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required',
            'question_id' => 'required',
            'option_text' => 'required',
            'point' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',

        ], [
            'category_id.required' => 'Kategori wajib diisi',
            'question_id.required' => 'Pertanyaan wajib diisi',
            'option_text.required' => 'Jawaban wajib diisi',
            'point.required' => 'Nilai wajib diisi',
            'point.regex:/^[0-9]+(\.[0-9][0-9]?)?$/' => 'Nilai harus bernilai angka',
        ]);

        $data = [
            'category_id' => $request->input('category_id'),
            'question_id' => $request->input('question_id'),
            'option_text' => $request->input('option_text'),
            'point' => $request->input('point'),
        ];

        $option = Option::findOrFail($id);

        $option->update($data);

        return redirect('/admin/jenjang_pendidikan/options')->with([
            'message' => 'Pertanyaan berhasil dibuat !',
            'alert-type' => 'success'
        ]);
    }

    public function update_jenjang_fungsional(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required',
            'question_id' => 'required',
            'option_text' => 'required',
            'point' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',

        ], [
            'category_id.required' => 'Kategori wajib diisi',
            'question_id.required' => 'Pertanyaan wajib diisi',
            'option_text.required' => 'Jawaban wajib diisi',
            'point.required' => 'Nilai wajib diisi',
            'point.regex:/^[0-9]+(\.[0-9][0-9]?)?$/' => 'Nilai harus bernilai angka',
        ]);

        $data = [
            'category_id' => $request->input('category_id'),
            'question_id' => $request->input('question_id'),
            'option_text' => $request->input('option_text'),
            'point' => $request->input('point'),
        ];

        $option = Option::findOrFail($id);

        $option->update($data);

        return redirect('/admin/jenjang_pendidikan/options')->with([
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

    public function destroy_jenjang_pendidikan($id)
    {
        $option = Option::findOrFail($id);

        $option->delete();
        // Alert::success('Data Biaya', 'Berhasil dihapus!!');
        return redirect('/admin/jenjang_pendidikan/options')->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function destroy_jenjang_fungsional($id)
    {
        $option = Option::findOrFail($id);

        $option->delete();
        // Alert::success('Data Biaya', 'Berhasil dihapus!!');
        return redirect('/admin/jenjang_fungsional/options')->with([
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
