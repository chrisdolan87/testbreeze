<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function create()
    {
        $genres = Genre::latest()->get();

        return view('upload', [
            'genres' => $genres,
        ]);
    }

    public function store()
    {
        // return request()->all();
        $attributes = request()->validate([
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'genre' => ['required', 'max:255'],
            'description' => ['required', 'min:20'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png'],
            'price' => ['required', 'numeric', 'between:0,9999.99']
        ]);

        // Create title slug and make sure it is unique
        $attributes['slug'] = $this->generateUniqueSlug($attributes['title'], Book::class);

        // Check if the author already exists in the author table. If it exists, use this as the author for this book. If not, add this author to the table
        $authorSlug = Str::slug($attributes['author']);
        $author = Author::firstOrCreate(
            ['slug' => $authorSlug], // Check for an existing author by slug
            ['name' => $attributes['author']] // If not found, create with name and slug
        );

        // Check if the genre already exists in the genre table. If it exists, use this as the genre for this book. If not, add this genre to the table
        $genreSlug = Str::slug($attributes['genre']);
        $genre = Genre::firstOrCreate(
            ['slug' => $genreSlug], // Check for an existing genre by slug
            ['name' => $attributes['genre']] // If not found, create with name and slug
        );

        // Store the image
        if (request()->hasFile('image') && request()->file('image')->isValid()) {
            $attributes['image'] = request()->file('image')->store('images', 'public');
        } else {
            dd('No valid image uploaded');
        }

        Book::create([
            'user_id' => Auth::user()->id,
            'title' => $attributes['title'],
            'slug' => $attributes['slug'],
            'author_id' => $author->id,
            'genre_id' => $genre->id,
            'description' => $attributes['description'],
            'image' => $attributes['image'],
            'price' => $attributes['price']
        ]);

        return redirect('/dashboard')->with('book-added', 'Book added successfully!');
    }



    public function edit($book_id)
    {
        $genres = Genre::latest()->get();

        // Find the book by ID
        $book = Book::find($book_id);

        // If the book doesn't exist, redirect back with an error message
        if (!$book) {
            return redirect()->back()->withErrors('Book not found.');
        }

        // Pass the book data to the view
        return view('edit-upload', [
            'book' => $book,
            'genres' => $genres,
        ]);
    }



    public function update($book_id)  // Pass $book_id from the URL
    {
        $genres = Genre::latest()->get();

        // Retrieve the book by ID
        $book = Book::find($book_id);

        // If the book doesn't exist, redirect back with an error message
        if (!$book) {
            return redirect()->back()->withErrors('Book not found.');
        }

        // Validate the incoming request
        $attributes = request()->validate([
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'genre' => ['required', 'max:255'],
            'description' => ['required', 'min:20'],
            'image' => ['image', 'mimes:jpg,jpeg,png'],
            'price' => ['required', 'numeric', 'between:0,9999.99']
        ]);

        // Create title slug and make sure it is unique
        $attributes['slug'] = $this->generateUniqueSlug($attributes['title'], Book::class);

        // Check if the author already exists in the author table. If it exists, use this as the author for this book. If not, add this author to the table
        $authorSlug = Str::slug($attributes['author']);
        $author = Author::firstOrCreate(
            ['slug' => $authorSlug], // Check for an existing author by slug
            ['name' => $attributes['author']] // If not found, create with name and slug
        );

        // Check if the genre already exists in the genre table. If it exists, use this as the genre for this book. If not, add this genre to the table
        $genreSlug = Str::slug($attributes['genre']);
        $genre = Genre::firstOrCreate(
            ['slug' => $genreSlug], // Check for an existing genre by slug
            ['name' => $attributes['genre']] // If not found, create with name and slug
        );

        // Store the image
        if (request()->hasFile('image')) {
            $attributes['image'] = request()->file('image')->store('images', 'public');
            // Delete the old book image from storage
            if ($book->image) {
                Storage::delete($book->image);
            }
        } else $attributes['image'] = $book->image;

        // Update the book with validated data
        $book->update([
            'title' => $attributes['title'],
            'slug' => $attributes['slug'],
            'author_id' => $author->id,
            'genre_id' => $genre->id,
            'description' => $attributes['description'],
            'image' => $attributes['image'],
            'price' => $attributes['price']
        ]);

        // Redirect back to the book page with a success message
        return redirect("/books/{$book->slug}")->with('book-updated', 'Book updated successfully.');
    }



    public function destroy(Request $request, $book_id)
    {
        // Find the book
        $book = Book::find($book_id);

        if (!$book) {
            return redirect()->back()->withErrors('Book not found.');
        }

        // Delete the book image from storage
        if ($book->image) {
            Storage::delete($book->image);
        }

        // Delete the book
        $book->delete();

        return redirect('/dashboard')->with('book-deleted', 'Book deleted!');
    }



    private function generateUniqueSlug($title, $book)
    {
        // Make a slug from the title as normal
        $slug = Str::slug($title);

        // Create an counter to add to the end of the slug if it already exists in the database
        $counter = 1;

        while ($book::where('slug', $slug)->exists()) {
            // If slug exists in the DB, add the counter to the end and check again
            $slug = $slug . '-' . $counter;
            $counter++; // Increment the counter
        }

        return $slug;
    }
}
