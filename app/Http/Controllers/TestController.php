<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Option;
use App\Models\Result;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $data = auth()->user();

        $categories = Category::with(['categoryQuestions' => function ($query) {
            $query->inRandomOrder()
                ->with(['questionOptions' => function ($query) {
                    $query->inRandomOrder();
                }]);
        }])
            ->whereHas('categoryQuestions')
            ->get();

        return view('dosen.test.index', compact('data', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'questions' => 'required|array',
            'questions.*' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|exists:options,id',
        ], [
            'questions.required' => 'tidak ada pertanyaan',
            'questions.*.required' => 'Pertanyaan wajib diisi',
        ]);

        $user = auth()->user();

        $options = Option::find(array_values($request->input('questions')));

        $data = [
            'user_id' => $user['id'],
            'total_points' => $options->sum('point')
        ];

        $result = Result::create($data);

        $questions = $options->mapWithKeys(function ($option) {
            return [
                $option->question_id => [
                    'option_id' => $option->id,
                    'points' => $option->point
                ]
            ];
        })->toArray();

        $result->questions()->sync($questions);

        return redirect()->route('dosen.results.show', $result->id);
    }
}
