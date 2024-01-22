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

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = auth()->user();

        $categories = Category::all()->pluck('name', 'id');

        return view('admin.question.create', compact('data', 'categories'));
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

    public function massDestroy()
    {
        Question::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
