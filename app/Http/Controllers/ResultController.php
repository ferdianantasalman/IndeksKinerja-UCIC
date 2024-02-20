<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Result;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = auth()->user();

        $results = Result::all();

        return view('admin.result.index', compact('data', 'results'));
    }

    public function index_jenjang_pendidikan(): View
    {
        $data = auth()->user();

        $results = Result::where('category', '=', 'Jenjang Pendidikan')->get();

        return view('admin.jenjang_pendidikan.result.index', compact('data', 'results'));
    }

    public function index_jenjang_fungsional(): View
    {
        $data = auth()->user();

        $results = Result::where('category', '=', 'Jenjang Fungsional')->get();

        return view('admin.jenjang_fungsional.result.index', compact('data', 'results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = auth()->user();

        $questions = Question::all()->pluck('question_text', 'id');

        return view('admin.results.create', compact('data', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'total_points' => 'nullable',
            'questions' => 'array',
            'questions.*' => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/',

        ], [
            'questions.array' => 'Pertanyaan tidak ada',
            'questions.*.regex:/^[0-9]+(\.[0-9][0-9]?)?$/' => 'hasil tidak berupa angka',
        ]);

        // $data = [
        //     'category_id' => $request->input('category_id'),
        //     'question_text' => $request->input('question_text'),
        // ];

        $user = auth()->user();

        $result = Question::create(['user_id' => $user['id']]);
        // $result = Result::create($request->validated() + ['user_id' => auth()->id()]);

        $result->questions()->sync($request->input('questions', []));

        return redirect()->route('admin.results.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Result $result): View
    {
        $data = auth()->user();

        $results = $result;

        return view('admin.result.detail', compact('data', 'results'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result): View
    {
        $data = auth()->user();

        $questions = Question::all()->pluck('question_text', 'id');

        return view('admin.results.edit', compact('result', 'data', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        $result->update($request->validated() + ['user_id' => auth()->id()]);
        $result->questions()->sync($request->input('questions', []));

        return redirect()->route('admin.results.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        $result->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }


    public function massDestroy()
    {
        Result::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
