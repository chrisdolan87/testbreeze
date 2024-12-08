<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UploadController;
use App\Mail\Welcome;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

// // EMAIL TEST ROUTE
// Route::get('/emailtest', function () {
//     Mail::to('d7oln@hotmail.com')->send(new Welcome);
//     return 'Test email sent';
// });

// ROUTE FOR HOME PAGE
Route::get('/', function () {
    $books = Book::latest()
        ->with(['author', 'genre']); // Eager load author and genre relationships for efficiency
    $genres = Genre::latest()->get();

    return view('home', [
        'books' => $books->paginate(20),
        'genres' => $genres,
    ]);
})->name('home');



// ROUTE TO SINGLE BOOK PAGE
Route::get('/books/{book:slug}', function (Book $book) {
    $genres = Genre::latest()->get();

    return view('book', [
        'book' => $book,
        'genres' => $genres,
    ]);
});



// ROUTE TO VIEW ALL BOOKS IN A SPECIFIC GENRE
Route::get('/genres/{genre:slug}', function (Genre $genre) {
    $genres = Genre::latest()->get();

    return view('home', [
        'books' => $genre->books()->with(['genre', 'author'])->paginate(12),
        'genres' => $genres,
    ]);
});



// ROUTE TO VIEW ALL BOOKS BY A SPECIFIC AUTHOR
Route::get('/authors/{author:slug}', function (Author $author) {
    $genres = Genre::latest()->get();

    return view('home', [
        'books' => $author->books()->with(['genre', 'author'])->paginate(12),
        'genres' => $genres,
    ]);
});



// ROUTE TO VIEW ALL BOOKS FROM A SPECIFIC USER
Route::get('/users/{user:username}', function (User $user) {
    $genres = Genre::latest()->get();

    return view('home', [
        'books' => $user->books()->with(['genre', 'author'])->paginate(12),
        'genres' => $genres,
    ]);
});



// ROUTE TO VIEW ALL BOOKS BASED ON USER SEARCH
Route::get('/search', function (Request $request) {
    $genres = Genre::latest()->get();
    $search = $request->input('search');

    $books = Book::latest()
        ->with(['author', 'genre'])
        ->where('title', 'LIKE', "%{$search}%") // Search in title
        ->orWhereHas('author', function ($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%"); // Search in author's name
        })
        ->orWhereHas('genre', function ($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%"); // Search in genre's name
        })
        ->paginate(12);

    return view('home', [
        'books' => $books,
        'genres' => $genres,
    ]);
});



// ROUTE TO VIEW DASHBOARD WHEN LOGGED IN
Route::get('/dashboard', function () {
    // Get the logged-in user
    $user = Auth::user();

    $users = User::latest()->get();

    $genres = Genre::latest()->get();

    $books = Book::latest()
        ->with(['author', 'genre'])
        ->where('user_id', $user->id)
        ->paginate(12);

    $wishlist = $user->wishlist()->with(['author', 'genre'])->paginate(12);

    return view('dashboard', [
        'users' => $users,
        'books' => $books,
        'genres' => $genres,
        'wishlist' => $wishlist
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');



// ALL REVIEW ROUTES
Route::get('/reviews/{book:slug}', [ReviewController::class, 'view'])->name('reviews.view');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/review/create/{book_id}', [ReviewController::class, 'create'])->middleware('block_admin')->name('review.create');
    Route::post('/review/post/{book_id}', [ReviewController::class, 'store'])->middleware('block_admin')->name('review.store');
    Route::get('/review/edit/{review_id}', [ReviewController::class, 'edit'])->name('review.edit');
    Route::post('/review/update/{review_id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/review/delete/{review_id}', [ReviewController::class, 'destroy'])->name('review.destroy');
});



// ALL UPLOAD ROUTES
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/upload', [UploadController::class, 'create'])->middleware('block_admin');
    Route::post('/upload/store', [UploadController::class, 'store'])->middleware('block_admin');
    Route::get('/upload/edit/{book_id}', [UploadController::class, 'edit'])->name('upload.edit');
    Route::post('/upload/update/{book_id}', [UploadController::class, 'update'])->name('upload.update');
    Route::post('/upload/delete/{book_id}', [UploadController::class, 'destroy'])->name('upload.delete');
});



// WISHLIST ROUTES
Route::middleware('auth', 'verified', 'block_admin')->group(function () {
    Route::post('/wishlist/add/{book_id}', function ($book_id) {
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
    });

    Route::post('/wishlist/remove/{book_id}', function ($book_id) {
        $user = Auth::user();

        // Check if the book exists in the user's wishlist
        if (!$user->wishlist()->where('book_id', $book_id)->exists()) {
            return redirect()->back()->with('info', 'Book is not in your wishlist.');
        }

        // Detach the book from the user's wishlist
        $user->wishlist()->detach($book_id);

        return redirect()->back()->with('success', 'Book removed from wishlist.');
    });
});



// BASKET ROUTES
Route::middleware('auth', 'verified', 'block_admin')->group(function () {
    Route::get('/basket', [BasketController::class, 'view'])->name('basket.view');
    Route::post('/basket/add/{book_id}', [BasketController::class, 'store'])->name('basket.store');
    Route::post('/basket/update/{item}/{action}', [BasketController::class, 'update'])->name('basket.update');
    Route::delete('/basket/remove/{book_id}', [BasketController::class, 'destroy'])->name('basket.destroy');
});



// PROFILE ROUTES
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// ADMIN ROUTES
Route::middleware('is_admin', 'verified')->group(function () {
    Route::get('/admin/createAdmin', [ProfileController::class, 'createAdminForm'])->name('admin.createAdminForm');
    Route::post('/admin/createAdmin', [ProfileController::class, 'createAdmin'])->name('admin.createAdmin');
    Route::delete('/admin/deleteProfile/{user_id}', [ProfileController::class, 'adminDeleteProfile'])->name('admin.deleteProfile');
});



require __DIR__ . '/auth.php';