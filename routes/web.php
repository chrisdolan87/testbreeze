<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UploadController;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
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
    $books = Book::latest()
        ->with(['author', 'genre']); // Eager load author and genre relationships for efficiency

    if ($search = request('search')) {
        $books->where('title', 'like', '%' . $search . '%')
            ->orWhereHas('author', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%'); // Search in the author's name
            })
            ->orWhereHas('genre', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%'); // Search in the genre's name
            });
    }

    return view('home', [
        'books' => $books->paginate(20)
    ]);
})->name('home');

Route::get('/books/{book:slug}', function (Book $book) {
    return view('book', [
        'book' => $book
    ]);
});

Route::get('/genres/{genre:slug}', function (Genre $genre) {
    return view('home', [
        'books' => $genre->books()->with(['genre', 'author'])->paginate(12)
    ]);
});

Route::get('/authors/{author:slug}', function (Author $author) {
    return view('home', [
        'books' => $author->books()->with(['genre', 'author'])->paginate(12)
    ]);
});

Route::get('/users/{user:username}', function (User $user) {
    return view('home', [
        'books' => $user->books()->with(['genre', 'author'])->paginate(12)
    ]);
});



// REVIEW ROUTES
Route::get('/reviews/{book:slug}', [ReviewController::class, 'view'])->name('reviews.view');
Route::middleware('auth')->group(function () {
    Route::get('/review/create', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/review/edit/{review_id}', [ReviewController::class, 'edit'])->name('review.edit');
    Route::post('/review/update/{review_id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/review/delete/{review_id}', [ReviewController::class, 'destroy'])->name('review.destroy');
});



// UPLOAD ROUTES
Route::get('/upload', [UploadController::class, 'create']);
Route::post('/upload/store', [UploadController::class, 'store']);
Route::post('/upload/delete', [UploadController::class, 'destroy']);



// WISHLIST ROUTES
Route::post('/wishlist/add/{book_id}', function (Request $request, $book_id) {
    $user = Auth::user();

    // Check if the book exists
    $book = Book::find($book_id);
    if (!$book) {
        return redirect()->back()->withErrors('The book does not exist.');
    }

    // Prevent duplicate wishlist entries
    if ($user->wishlist()->where('book_id', $book_id)->exists()) {
        return redirect()->back()->with('info', 'Book is already in your wishlist.');
    }

    // Attach the book to the user's wishlist
    $user->wishlist()->attach($book_id);

    return redirect()->back()->with('success', 'Book added to wishlist!');
})->middleware(['auth', 'verified']);

Route::post('/wishlist/remove/{book_id}', function (Request $request, $book_id) {
    $user = Auth::user();

    // Check if the book exists in the user's wishlist
    if (!$user->wishlist()->where('book_id', $book_id)->exists()) {
        return redirect()->back()->with('info', 'Book is not in your wishlist.');
    }

    // Detach the book from the user's wishlist
    $user->wishlist()->detach($book_id);

    return redirect()->back()->with('success', 'Book removed from wishlist.');
})->middleware(['auth', 'verified']);



// BASKET ROUTES
Route::middleware('auth')->group(function () {
    Route::get('/basket', [BasketController::class, 'view'])->name('basket.view');
    Route::post('/basket/add/{book_id}', [BasketController::class, 'store'])->name('basket.store');
    Route::post('/basket/update/{item}/{action}', [BasketController::class, 'update'])->name('basket.update');
    Route::delete('/basket/remove/{book_id}', [BasketController::class, 'destroy'])->name('basket.destroy');
});



Route::get('/dashboard', function () {
    // Get the logged-in user
    $user = Auth::user();

    $books = Book::latest()
        ->with(['author', 'genre'])
        ->where('user_id', $user->id)
        ->paginate(12);

    $wishlist = $user->wishlist()->with(['author', 'genre'])->paginate(12);

    return view('dashboard', [
        'books' => $books,
        'wishlist' => $wishlist
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');



// PROFILE ROUTES
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
