<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function view(Book $book)
    {
        return view('reviews', [
            'book' => $book,
            'reviews' => $book->reviews()->paginate(10)
        ]);
    }



    public function create(Request $request)
    {
        $book_id = $request->input('book_id'); // Retrieve book_id from the GET request
        $book_slug = $request->input('book_slug'); // Retrieve book_slug from the GET request

        return view('review-form', [
            'book_id' => $book_id,
            'book_slug' => $book_slug
        ]);
    }



    public function store(Request $request)
    {
        $book_id = $request->input('book_id'); // Retrieve book_id from the GET request
        $book_slug = $request->input('book_slug'); // Retrieve book_slug from the GET request
        $user_id = Auth::user()->id;

        // Validate 
        $attributes = request()->validate([
            'book_id' => ['required'],
            'rating' => ['required'],
            'review' => ['required', 'min:20']
        ]);

        // Check if this user has already reviewed this book
        $existingReview = Review::where('user_id', $user_id)
            ->where('book_id', $book_id)
            ->first();

        // If there is already a review for this book by this user, redirect back
        if ($existingReview) {
            return redirect("/reviews/$book_slug")->with('error', 'You have already reviewed this book.');
        }

        Review::create([
            'user_id' => Auth::user()->id,
            'book_id' => $attributes['book_id'],
            'rating' => $attributes['rating'],
            'review' => $attributes['review'],
        ]);

        return redirect("/reviews/$book_slug")->with('review-added', 'Review added!');
    }



    public function edit($review_id)
    {
        // Find the review by ID
        $review = Review::find($review_id);

        // If the review doesn't exist, redirect back with an error message
        if (!$review) {
            return redirect()->back()->withErrors('Review not found.');
        }

        // Pass the review data to the view
        return view('edit-review', [
            'review' => $review
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
            'rating' => ['required'],
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
    


    public function destroy(Request $request, $review_id)
    {
        $book_slug = $request->input('book_slug');

        // Retrieve the review by ID
        $review = Review::find($review_id);

        // If review is not found, redirect back
        if (!$review) {
            return redirect()->back()->withErrors('Review not found.');
        }

        // Delete the review
        $review->delete();

        return redirect("/reviews/$book_slug")->with('review-deleted', 'Review deleted!');
    }
}
