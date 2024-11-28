<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function create()
    {
        return view('upload');
    }

    

    public function store()
    {
        // return request()->all();
        $attributes = request()->validate([
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'genre' => ['required', 'max:255'],
            'description' => ['required', 'min:20'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'price' => ['required', 'numeric', 'between:0,9999.99']
        ]);

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
        }

        Book::create([
            'user_id' => Auth::user()->id,
            'title' => $attributes['title'],
            'slug' => Str::slug($attributes['title']),
            'author_id' => $author->id,
            'genre_id' => $genre->id,
            'description' => $attributes['description'],
            'image' => $attributes['image'],
            'price' => $attributes['price']
        ]);

        return redirect('/dashboard')->with('success', 'Book created successfully!');
    }


    
    public function destroy(Request $request)
    {
        $bookId = $request->input('book_id');

        // Find the book
        $book = Book::find($bookId);

        if (!$book) {
            return redirect()->back()->withErrors('Book not found.');
        }

        // Delete the book
        $book->delete();

        return redirect('/dashboard')->with('book-deleted', 'Book deleted!');
    }
}
