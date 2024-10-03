<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TalkProposalController;
use App\Http\Controllers\ReviewController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('talk_proposals', TalkProposalController::class);
    Route::get('talk_proposals/{id}/review', [TalkProposalController::class, 'review'])->name('talk_proposals.review');
    Route::post('/talk-proposals/{id}/review', [TalkProposalController::class, 'submitReview'])->name('talk-proposals.submitReview');

    Route::resource('reviews', ReviewController::class);
    Route::get('/reviewers/dashboard', [ReviewController::class, 'dashboard'])->name('reviewer.dashboard');

    Route::get('/reviewer/proposal/{id}', [TalkProposalController::class, 'show'])->name('reviewer.proposal.show');
});


require __DIR__ . '/auth.php';
