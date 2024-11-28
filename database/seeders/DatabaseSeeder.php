<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create user with my details
        $user1 = User::factory()->create([
            'name' => 'Chris Dolan',
            'username' => 'd7oln',
            'email' => 'd7oln@hotmail.com',
            'password' => 'password',
        ]);
        // Create 3 new users using factory
        $user2 = User::factory()->create();
        $user3 = User::factory()->create();
        $user4 = User::factory()->create();


        // Create 3 authors
        $orwell = Author::create([
            'name' => 'George Orwell',
            'slug' => 'george-orwell',
        ]);
        $huxley = Author::create([
            'name' => 'Aldous Huxley',
            'slug' => 'aldous-huxley',
        ]);
        $king = Author::create([
            'name' => 'Stephen King',
            'slug' => 'stephen-king',
        ]);
        $fry = Author::create([
            'name' => 'Stephen Fry',
            'slug' => 'stephen-fry',
        ]);


        // Create 3 genres
        $scifi = Genre::create([
            'name' => 'Science Fiction',
            'slug' => 'science-fiction',
        ]);
        $horror = Genre::create([
            'name' => 'Horror',
            'slug' => 'horror',
        ]);
        $fantasy = Genre::create([
            'name' => 'Fantasy',
            'slug' => 'fantasy',
        ]);
        $history = Genre::create([
            'name' => 'History',
            'slug' => 'history',
        ]);


        // Create books
        Book::create([
            'user_id' => $user1->id,
            'author_id' => $orwell->id,
            'genre_id' => $scifi->id,
            'title' => 'Book 1',
            'slug' => 'book1',
            'description' => 'Book 1 description',
            'image' => 'images/1984cover.jpg',
            'price' => '1.23',
        ]);
        Book::create([
            'user_id' => $user2->id,
            'author_id' => $huxley->id,
            'genre_id' => $fantasy->id,
            'title' => 'Book 2',
            'slug' => 'book2',
            'description' => 'Book 2 description',
            'image' => 'images/mockingbirdcover.jpg',
            'price' => '2.34',
        ]);
        Book::create([
            'user_id' => $user3->id,
            'author_id' => $king->id,
            'genre_id' => $horror->id,
            'title' => 'Book 3',
            'slug' => 'book3',
            'description' => 'Book 3 description',
            'image' => 'images/1984cover.jpg',
            'price' => '3.45',
        ]);
        Book::create([
            'user_id' => $user4->id,
            'author_id' => $fry->id,
            'genre_id' => $history->id,
            'title' => 'Book 4',
            'slug' => 'book4',
            'description' => 'Book 4 description',
            'image' => 'images/1984cover.jpg',
            'price' => '3.45',
        ]);
        Book::create([
            'user_id' => $user1->id,
            'author_id' => $king->id,
            'genre_id' => $fantasy->id,
            'title' => 'Book 5',
            'slug' => 'book5',
            'description' => 'Book 5 description',
            'image' => 'images/1984cover.jpg',
            'price' => '4.56',
        ]);
        Book::create([
            'user_id' => $user2->id,
            'author_id' => $orwell->id,
            'genre_id' => $horror->id,
            'title' => 'Book 6',
            'slug' => 'book6',
            'description' => 'Book 6 description',
            'image' => 'images/mockingbirdcover.jpg',
            'price' => '5.67',
        ]);
        Book::create([
            'user_id' => $user3->id,
            'author_id' => $huxley->id,
            'genre_id' => $history->id,
            'title' => 'Book 7',
            'slug' => 'book7',
            'description' => 'Book 7 description',
            'image' => 'images/1984cover.jpg',
            'price' => '6.78',
        ]);
        Book::create([
            'user_id' => $user4->id,
            'author_id' => $fry->id,
            'genre_id' => $scifi->id,
            'title' => 'Book 8',
            'slug' => 'book8',
            'description' => 'Book 8 description',
            'image' => 'images/1984cover.jpg',
            'price' => '6.78',
        ]);
        Book::create([
            'user_id' => $user1->id,
            'author_id' => $orwell->id,
            'genre_id' => $scifi->id,
            'title' => 'Book 9',
            'slug' => 'book9',
            'description' => 'Book 9 description',
            'image' => 'images/1984cover.jpg',
            'price' => '1.23',
        ]);
        Book::create([
            'user_id' => $user2->id,
            'author_id' => $huxley->id,
            'genre_id' => $fantasy->id,
            'title' => 'Book 10',
            'slug' => 'book10',
            'description' => 'Book 10 description',
            'image' => 'images/mockingbirdcover.jpg',
            'price' => '2.34',
        ]);
        Book::create([
            'user_id' => $user3->id,
            'author_id' => $fry->id,
            'genre_id' => $horror->id,
            'title' => 'Book 11',
            'slug' => 'book11',
            'description' => 'Book 11 description',
            'image' => 'images/1984cover.jpg',
            'price' => '3.45',
        ]);
        Book::create([
            'user_id' => $user4->id,
            'author_id' => $king->id,
            'genre_id' => $fantasy->id,
            'title' => 'Book 12',
            'slug' => 'book12',
            'description' => 'Book 12 description',
            'image' => 'images/1984cover.jpg',
            'price' => '3.45',
        ]);
        Book::create([
            'user_id' => $user1->id,
            'author_id' => $king->id,
            'genre_id' => $fantasy->id,
            'title' => 'Book 13',
            'slug' => 'book13',
            'description' => 'Book 13 description',
            'image' => 'images/1984cover.jpg',
            'price' => '4.56',
        ]);
        Book::create([
            'user_id' => $user2->id,
            'author_id' => $orwell->id,
            'genre_id' => $horror->id,
            'title' => 'Book 14',
            'slug' => 'book14',
            'description' => 'Book 14 description',
            'image' => 'images/mockingbirdcover.jpg',
            'price' => '5.67',
        ]);
        Book::create([
            'user_id' => $user3->id,
            'author_id' => $huxley->id,
            'genre_id' => $scifi->id,
            'title' => 'Book 15',
            'slug' => 'book15',
            'description' => 'Book 15 description',
            'image' => 'images/1984cover.jpg',
            'price' => '6.78',
        ]);
        Book::create([
            'user_id' => $user4->id,
            'author_id' => $orwell->id,
            'genre_id' => $scifi->id,
            'title' => 'Book 16',
            'slug' => 'book16',
            'description' => 'Book 16 description',
            'image' => 'images/1984cover.jpg',
            'price' => '6.78',
        ]);
    }
}
