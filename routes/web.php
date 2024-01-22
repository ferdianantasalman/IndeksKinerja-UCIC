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

        // Text
        Route::get('/test', [TestController::class, 'index'])->name('dosen.test');
        Route::post('/test', [TestController::class, 'store'])->name('dosen.test.store');
        Route::get('/results/{result_id}', [ResultController::class, 'show'])->name('dosen.results.show');

        Route::resource('/jenjangpendidikan', JenjangPendidikanController::class);
        Route::resource('/jenjangfungsional', JenjangFungsionalController::class);
    });
});
