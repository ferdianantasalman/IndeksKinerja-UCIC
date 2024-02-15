<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = auth()->user();

        $questions = Question::all();

        return view('admin.question.index', compact('data', 'questions'));
    }

    public function index_jenjang_pendidikan(): View
    {
        $data = auth()->user();

        $questions = Question::where('category_id', '=', 1)->get();

        return view('admin.jenjang_pendidikan.question.index', compact('data', 'questions'));
    }

    public function index_jenjang_fungsional(): View
    {
        $data = auth()->user();

        $questions = Question::where('category_id', '=', 2)->get();

        return view('admin.jenjang_fungsional.question.index', compact('data', 'questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = auth()->user();

        $categories = Category::all()->pluck('name', 'id');

        return view('admin.question.create', compact('data', 'categories'));
    }

    public function create_jenjang_pendidikan(): View
    {
        $data = auth()->user();

        $categories = Category::where('id', '=', 1)->pluck('name', 'id');

        return view('admin.jenjang_pendidikan.question.create', compact('data', 'categories'));
    }

    public function create_jenjang_fungsional(): View
    {
        $data = auth()->user();

        $categories = Category::where('id', '=', 2)->pluck('name', 'id');

        return view('admin.jenjang_fungsional.question.create', compact('data', 'categories'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required',
            'question_text' => 'required',

        ], [
            'category_id.required' => 'kategori wajib diisi',
            'question_text.required' => 'Pertanyaan wajib diisi',
        ]);

        $data = [
            'category_id' => $request->input('category_id'),
            'question_text' => $request->input('question_text'),
        ];

        Question::create($data);

        return redirect('/admin/questions')->with([
            'message' => 'Pertanyaan berhasil dibuat !',
            'alert-type' => 'success'
        ]);
    }

    public function store_jenjang_pendidikan(Request $request): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required',
            'question_text' => 'required',

        ], [
            'category_id.required' => 'kategori wajib diisi',
            'question_text.required' => 'Pertanyaan wajib diisi',
        ]);

        $data = [
            'category_id' => $request->input('category_id'),
            'question_text' => $request->input('question_text'),
        ];

        Question::create($data);

        return redirect('/admin/jenjang_pendidikan/questions')->with([
            'message' => 'Pertanyaan berhasil dibuat !',
            'alert-type' => 'success'
        ]);
    }

    public function store_jenjang_fungsional(Request $request): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required',
            'question_text' => 'required',

        ], [
            'category_id.required' => 'kategori wajib diisi',
            'question_text.required' => 'Pertanyaan wajib diisi',
        ]);

        $data = [
            'category_id' => $request->input('category_id'),
            'question_text' => $request->input('question_text'),
        ];

        Question::create($data);

        return redirect('/admin/jenjang_fungsional/questions')->with([
            'message' => 'Pertanyaan berhasil dibuat !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return view('admin.question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $data = auth()->user();

        // $categories = Category::findOrFail($id)->pluck('name', 'id')->get();
        $categories = Category::all()->pluck('name', 'id');

        $questions = Question::findOrFail($id);

        // dd($categories);

        return view('admin.question.edit', compact('data', 'categories', 'questions'));
    }

    public function edit_jenjang_pendidikan($id): View
    {
        $data = auth()->user();

        // $categories = Category::findOrFail($id)->pluck('name', 'id')->get();
        $categories = Category::where('id', '=', 1)->pluck('name', 'id');

        $questions = Question::findOrFail($id);

        // dd($categories);

        return view('admin.jenjang_pendidikan.question.edit', compact('data', 'categories', 'questions'));
    }

    public function edit_jenjang_fungsional($id): View
    {
        $data = auth()->user();

        // $categories = Category::findOrFail($id)->pluck('name', 'id')->get();
        $categories = Category::where('id', '=', 2)->pluck('name', 'id');

        $questions = Question::findOrFail($id);

        // dd($categories);

        return view('admin.jenjang_fungsional.question.edit', compact('data', 'categories', 'questions'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required',
            'question_text' => 'required',

        ], [
            'category_id.required' => 'kategori wajib diisi',
            'question_text.required' => 'Pertanyaan wajib diisi',
        ]);

        $data = [
            'category_id' => $request->input('category_id'),
            'question_text' => $request->input('question_text'),
        ];

        $question = Question::findOrFail($id);

        $question->update($data);

        return redirect('/admin/questions')->with([
            'message' => 'Pertanyaan berhasil dibuat !',
            'alert-type' => 'success'
        ]);
    }

    public function update_jenjang_pendidikan(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required',
            'question_text' => 'required',

        ], [
            'category_id.required' => 'kategori wajib diisi',
            'question_text.required' => 'Pertanyaan wajib diisi',
        ]);

        $data = [
            'category_id' => $request->input('category_id'),
            'question_text' => $request->input('question_text'),
        ];

        $question = Question::findOrFail($id);

        $question->update($data);

        return redirect('/admin/jenjang_pendidikan/questions')->with([
            'message' => 'Pertanyaan berhasil dibuat !',
            'alert-type' => 'success'
        ]);
    }

    public function update_jenjang_fungsional(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required',
            'question_text' => 'required',

        ], [
            'category_id.required' => 'kategori wajib diisi',
            'question_text.required' => 'Pertanyaan wajib diisi',
        ]);

        $data = [
            'category_id' => $request->input('category_id'),
            'question_text' => $request->input('question_text'),
        ];

        $question = Question::findOrFail($id);

        $question->update($data);

        return redirect('/admin/jenjang_fungsional/questions')->with([
            'message' => 'Pertanyaan berhasil dibuat !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);

        $question->delete();
        // Alert::success('Data Biaya', 'Berhasil dihapus!!');
        return redirect('/admin/questions')->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function destroy_jenjang_pendidikan($id)
    {
        $question = Question::findOrFail($id);

        $question->delete();
        // Alert::success('Data Biaya', 'Berhasil dihapus!!');
        return redirect('/admin/jenjang_pendidikan/questions')->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function destroy_jenjang_fungsional($id)
    {
        $question = Question::findOrFail($id);

        $question->delete();
        // Alert::success('Data Biaya', 'Berhasil dihapus!!');
        return redirect('/admin/jenjang_fungsional/questions')->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function massDestroy()
    {
        Question::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
