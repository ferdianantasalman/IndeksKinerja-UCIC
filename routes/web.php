<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BobotNilaiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenjangFungsionalController;
use App\Http\Controllers\JenjangPendidikanController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('guest')->group(function () {
    // Landing
    Route::get('/', [HomeController::class, 'landing']);


    // Login
    Route::get('/login', [AuthController::class, 'login'])->name('login.index');
    Route::post('/login', [AuthController::class, 'loginStore'])->name('login');

    // Register
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'registerStore']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::prefix('admin')->middleware('roleAs:admin')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'admin']);

        // Bobot Nila
        Route::resource('/bobotnilai', BobotNilaiController::class);

        // CATEGORY
        Route::resource('/categories', CategoryController::class);
        Route::delete('categories_mass_destroy', [CategoryController::class, 'massDestroy'])->name('categories.mass_destroy');

        // questions
        Route::resource('/questions', QuestionController::class);
        Route::delete('questions_mass_destroy', [QuestionController::class, 'massDestroy'])->name('questions.mass_destroy');

        // options
        Route::resource('options', OptionController::class);
        Route::delete('options_mass_destroy', [OptionController::class, 'massDestroy'])->name('options.mass_destroy');

        // results
        Route::resource('results', ResultController::class);
        Route::delete('results_mass_destroy', [ResultController::class, 'massDestroy'])->name('results.mass_destroy');

        // =========== Jenjang Pendidikan ==========
        // questions
        Route::get('jenjang_pendidikan/questions', [QuestionController::class, 'index_jenjang_pendidikan'])->name('jenjang_pendidikan.questions');
        Route::get('jenjang_pendidikan/questions/create', [QuestionController::class, 'create_jenjang_pendidikan'])->name('jenjang_pendidikan.questions.create');
        Route::post('jenjang_pendidikan/questions', [QuestionController::class, 'store_jenjang_pendidikan'])->name('jenjang_pendidikan.questions.store');
        Route::get('jenjang_pendidikan/{question}/edit', [QuestionController::class, 'edit_jenjang_pendidikan'])->name('jenjang_pendidikan.questions.edit');
        Route::put('jenjang_pendidikan/questions/{question}', [QuestionController::class, 'update_jenjang_pendidikan'])->name('jenjang_pendidikan.questions.update');
        Route::delete('jenjang_pendidikan/questions/{question}', [QuestionController::class, 'destroy_jenjang_pendidikan'])->name('jenjang_pendidikan.questions.destroy');
        Route::delete('questions_mass_destroy', [QuestionController::class, 'massDestroy'])->name('questions.mass_destroy');

        // options
        // Route::resource('jenjang_pendidikan/options', OptionController::class);
        Route::delete('options_mass_destroy', [OptionController::class, 'massDestroy'])->name('options.mass_destroy');

        // ======= Jenjang Fungsional ==========
        // questions
        Route::get('jenjang_fungsional/questions', [QuestionController::class, 'index_jenjang_fungsional'])->name('jenjang_fungsional.questions');
        Route::get('jenjang_fungsional/questions/create', [QuestionController::class, 'create_jenjang_fungsional'])->name('jenjang_fungsional.questions.create');
        Route::post('jenjang_fungsional/questions', [QuestionController::class, 'store_jenjang_fungsional'])->name('jenjang_fungsional.questions.store');
        Route::get('jenjang_fungsional/{question}/edit', [QuestionController::class, 'edit_jenjang_fungsional'])->name('jenjang_fungsional.questions.edit');
        Route::put('jenjang_fungsional/questions/{question}', [QuestionController::class, 'update_jenjang_fungsional'])->name('jenjang_fungsional.questions.update');
        Route::delete('jenjang_fungsional/questions/{question}', [QuestionController::class, 'destroy_jenjang_fungsional'])->name('jenjang_fungsional.questions.destroy');
        Route::delete('questions_mass_destroy', [QuestionController::class, 'massDestroy'])->name('questions.mass_destroy');

        // options
        // Route::resource('jenjang_fungsional/options', OptionController::class);
        Route::delete('options_mass_destroy', [OptionController::class, 'massDestroy'])->name('options.mass_destroy');
    });

    Route::prefix('rektorat')->middleware('roleAs:rektorat')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'rektorat']);
    });

    Route::prefix('fakultas')->middleware('roleAs:fakultas')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'fakultas']);
    });

    Route::prefix('prodi')->middleware('roleAs:prodi')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'prodi']);
    });

    Route::prefix('dosen')->middleware('roleAs:dosen')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'dosen']);


        // Result
        Route::get('/result', [TestController::class, 'index'])->name('dosen.result');
        Route::get('/result_pendidikan', [TestController::class, 'index_jenjang_pendidikan'])->name('dosen.result.pendidikan');
        Route::get('/result_fungsional', [TestController::class, 'index_jenjang_fungsional'])->name('dosen.result.fungsional');
        Route::get('/result/{result_id}', [TestController::class, 'show'])->name('dosen.result.show');
        // Route::resource('results', ResultController::class);

        // Test UI
        Route::get('/test', [TestController::class, 'test'])->name('dosen.test');
        Route::get('/test_pendidikan', [TestController::class, 'test_jenjang_pendidikan'])->name('dosen.test.pendidikan');
        Route::get('/test_fungsional', [TestController::class, 'test_jenjang_fungsional'])->name('dosen.test.fungsional');

        // Test Store
        Route::post('/test', [TestController::class, 'store'])->name('dosen.test.store');
        Route::post('/test_pendidikan', [TestController::class, 'store_jenjang_pendidikan'])->name('dosen.test.store.pendidikan');
        Route::post('/test_fungsional', [TestController::class, 'store_jenjang_fungsional'])->name('dosen.test.store.fungsional');

        // Delete
        Route::delete('/result_destroy/{result_id}', [TestController::class, 'destroy'])->name('dosen.result.destroy');

        // Route::resource('/jenjangpendidikan', JenjangPendidikanController::class);
        // Route::resource('/jenjangfungsional', JenjangFungsionalController::class);
    });
});
