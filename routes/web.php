<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\ConstituencyController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/locale/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'ne'])) {
        session()->put('locale', $lang);
    }
    return back();
})->name('locale.switch');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/compare', [CompareController::class, 'index'])->name('compare');

Route::prefix('candidates')->name('candidates.')->group(function () {
    Route::get('/', [CandidateController::class, 'index'])->name('index');
    Route::get('/{slug}', [CandidateController::class, 'show'])->name('show');
});

Route::prefix('parties')->name('parties.')->group(function () {
    Route::get('/', [PartyController::class, 'index'])->name('index');
    Route::get('/{slug}', [PartyController::class, 'show'])->name('show');
});

Route::prefix('constituencies')->name('constituencies.')->group(function () {
    Route::get('/', [ConstituencyController::class, 'index'])->name('index');
    Route::get('/{slug}', [ConstituencyController::class, 'show'])->name('show');
});

Route::get('/results', [ResultController::class, 'index'])->name('results.index');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/how-it-works', [FaqController::class, 'index'])->name('how-it-works');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
