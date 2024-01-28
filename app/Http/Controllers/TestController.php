<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Option;
use App\Models\Result;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $data = auth()->user();

        $results = Result::where('user_id', '=', auth()->user()['id'])->get();

        return view('dosen.test.index', compact('data', 'results'));
    }

    public function index_jenjang_pendidikan()
    {
        $data = auth()->user();

        $results = Result::where('user_id', '=', auth()->user()['id'])->where("category", "=", "Jenjang Pendidikan")->get();

        return view('dosen.jenjang_pendidikan.index', compact('data', 'results'));
    }

    public function index_jenjang_fungsional()
    {
        $data = auth()->user();

        $results = Result::where('user_id', '=', auth()->user()['id'])->where("category", "=", "Jenjang Fungsional")->get();

        return view('dosen.jenjang_fungsional.index', compact('data', 'results'));
    }

    public function test()
    {
        $data = auth()->user();

        $categories = Category::with(['categoryQuestions' => function ($query) {
            $query->orderBy('id', 'ASC')
                ->with(['questionOptions' => function ($query) {
                    $query->inRandomOrder();
                }]);
        }])
            ->whereHas('categoryQuestions')
            ->get();

        // dd($categories);

        return view('dosen.test.test', compact('data', 'categories'));
    }

    public function test_jenjang_pendidikan()
    {
        $data = auth()->user();

        $categories = Category::where("name", "=", "Jenjang Pendidikan")->with(['categoryQuestions' => function ($query) {
            $query->orderBy('id', 'ASC')
                ->with(['questionOptions' => function ($query) {
                    $query->inRandomOrder();
                }]);
        }])
            ->whereHas('categoryQuestions')
            ->get();

        // dd($categories);

        return view('dosen.jenjang_pendidikan.test', compact('data', 'categories'));
    }

    public function test_jenjang_fungsional()
    {
        $data = auth()->user();

        $categories = Category::where("name", "=", "Jenjang Fungsional")->with(['categoryQuestions' => function ($query) {
            $query->orderBy('id', 'ASC')
                ->with(['questionOptions' => function ($query) {
                    $query->inRandomOrder();
                }]);
        }])
            ->whereHas('categoryQuestions')
            ->get();

        // dd($categories);

        return view('dosen.jenjang_fungsional.test', compact('data', 'categories'));
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
            "category" => "",
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

        return redirect()->route('dosen.result');
    }

    public function store_jenjang_pendidikan(Request $request)
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
            'category' => "Jenjang Pendidikan",
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

        return redirect()->route('dosen.result.pendidikan');
    }

    public function store_jenjang_fungsional(Request $request)
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
            'category' => "Jenjang Fungsional",
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

        return redirect()->route('dosen.result.fungsional');
    }

    public function show($id): View
    {
        $data = auth()->user();

        $results = Result::findOrFail($id);

        // dd($result);

        return view('dosen.test.detail', compact('data', 'results'));
    }


    public function destroy($id)
    {
        $result = Result::findOrFail($id);

        $result->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }
}
