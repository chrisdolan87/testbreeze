<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    public function view(Book $book)
    {
        $genres = Genre::latest()->get();

        return view('reviews', [
            'book' => $book,
            'reviews' => $book->reviews()->paginate(10),
            'genres' => $genres,
        ]);
    }



    public function create($book_id)
    {
        $genres = Genre::latest()->get();

        return view('review-form', [
            'book_id' => $book_id,
            'genres' => $genres,
        ]);
    }



    public function store(Request $request, $book_id)
    {
        $user_id = Auth::user()->id;
        $book = Book::find($book_id);

        // Make sure a book with this book_id exists in the db
        if (!Book::where('id', $book_id)->exists()) {
            return redirect("/reviews/$book->slug")->with('error', 'Book not found.');
        }

        // Validate form inputs
        $attributes = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review' => ['required', 'min:20']
        ]);

        // Check if this user has already reviewed this book
        $existingReview = Review::where('user_id', $user_id)
            ->where('book_id', $book_id)
            ->first();

        // If there is already a review for this book by this user, redirect back
        if ($existingReview) {
            return redirect("/reviews/$book->slug")->with('error', 'You have already reviewed this book.');
        }

        Review::create([
            'user_id' => $user_id,
            'book_id' => $book_id,
            'rating' => $attributes['rating'],
            'review' => $attributes['review'],
        ]);

        return redirect("/reviews/$book->slug")->with('review-added', 'Review added!');
    }



    public function edit($review_id)
    {
        // Find the review by ID
        $review = Review::find($review_id);

        $genres = Genre::latest()->get();

        // If the review doesn't exist, redirect back with an error message
        if (!$review) {
            return redirect()->back()->withErrors('Review not found.');
        }

        // Pass the review data to the view
        return view('edit-review', [
            'review' => $review,
            'genres' => $genres,
        ]);
    }


    public function update(Request $request, $review_id)  // Pass $review_id from the URL
    {
        // Retrieve the review by ID
        $review = Review::find($review_id);

        // If the review doesn't exist, redirect back with an error message
        if (!$review) {
            return redirect()->back()->withErrors('Review not found.');
        }

        // Validate the incoming request
        $attributes = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review' => ['required', 'min:20'],
        ]);

        // Update the review with validated data
        $review->update([
            'rating' => $attributes['rating'],
            'review' => $attributes['review'],
        ]);

        // Redirect back to the review page with a success message
        return redirect("/reviews/{$review->book->slug}")->with('review-updated', 'Review updated successfully!');
    }



    public function destroy($review_id)
    {
        // Retrieve the review by ID
        $review = Review::find($review_id);

        // If review is not found, redirect back
        if (!$review) {
            return redirect()->back()->withErrors('Review not found.');
        }

        // Delete the review
        $review->delete();

        return redirect("/reviews/{$review->book->slug}")->with('review-deleted', 'Review deleted!');
    }
}
