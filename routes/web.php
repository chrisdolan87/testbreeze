<?php

use App\Http\Controllers\ProfileController;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\FrontMatter\Data\LibYamlFrontMatterParser;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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
    return view('home', [
        'books' => Book::all()
    ]);
});

Route::get('/books/{book:slug}', function (Book $book) {
    return view('book', [
        'book' => $book
    ]);
});

Route::get('/genres/{genre:slug}', function (Genre $genre) {
    return view('home', [
        'books' => $genre->books
    ]);
});








Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
