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
        // Create admin user
        User::factory()->create([
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'password',
            'is_admin' => true,
        ]);
        // Create user with my details
        $chris = User::factory()->create([
            'name' => 'Chris Dolan',
            'username' => 'cdolan',
            'email' => 'd7oln@hotmail.com',
            'password' => 'password',
        ]);
        // Create Pablo user
        $pablo = User::factory()->create([
            'name' => 'Pablo Salva Garcia',
            'username' => 'pablo',
            'email' => 'pablo@uws.com',
            'password' => 'password',
        ]);
        // Create 3 random users
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $user3 = User::factory()->create();



        // Create authors
        $king = Author::create([
            'name' => 'Stephen King',
            'slug' => 'stephen-king',
        ]);
        $tolkien = Author::create([
            'name' => 'J.R.R. Tolkien',
            'slug' => 'jrr-tolkien',
        ]);
        $rowling = Author::create([
            'name' => 'J.K. Rowling',
            'slug' => 'jk-rowling',
        ]);
        $austen = Author::create([
            'name' => 'Jane Austen',
            'slug' => 'jane-austen',
        ]);
        $hemingway = Author::create([
            'name' => 'Ernest Hemingway',
            'slug' => 'ernest-hemingway',
        ]);
        $orwell = Author::create([
            'name' => 'George Orwell',
            'slug' => 'george-orwell',
        ]);
        $fitzgerald = Author::create([
            'name' => 'F. Scott Fitzgerald',
            'slug' => 'f-scott-fitzgerald',
        ]);
        $dickens = Author::create([
            'name' => 'Charles Dickens',
            'slug' => 'charles-dickens',
        ]);



        // Create genres
        $fantasy = Genre::create([
            'name' => 'Fantasy',
            'slug' => 'fantasy',
        ]);
        $thriller = Genre::create([
            'name' => 'Thriller',
            'slug' => 'thriller',
        ]);
        $horror = Genre::create([
            'name' => 'Horror',
            'slug' => 'horror',
        ]);
        $romance = Genre::create([
            'name' => 'Romance',
            'slug' => 'romance',
        ]);
        $classics = Genre::create([
            'name' => 'Classics',
            'slug' => 'classics',
        ]);
        $literaryFiction = Genre::create([
            'name' => 'Literary Fiction',
            'slug' => 'literary-fiction',
        ]);
        $dystopian = Genre::create([
            'name' => 'Dystopian',
            'slug' => 'dystopian',
        ]);
        $historicalFiction = Genre::create([
            'name' => 'Historical Fiction',
            'slug' => 'historical-fiction',
        ]);
        $drama = Genre::create([
            'name' => 'Drama',
            'slug' => 'drama',
        ]);



        // Create books
        Book::create([
            'user_id' => $chris->id,
            'author_id' => $tolkien->id,
            'genre_id' => $fantasy->id,
            'title' => 'The Hobbit',
            'slug' => 'the-hobbit',
            'description' => 'A young hobbit embarks on a grand adventure to reclaim a treasure from a dragon.',
            'image' => 'images/the-hobbit.jpg',
            'price' => '10.99',
        ]);

        Book::create([
            'user_id' => $pablo->id,
            'author_id' => $rowling->id,
            'genre_id' => $fantasy->id,
            'title' => 'Harry Potter and the Philosopher\'s Stone',
            'slug' => 'harry-potter-1',
            'description' => 'A young wizard embarks on his journey at Hogwarts School of Witchcraft and Wizardry.',
            'image' => 'images/harry-potter-philosophers-stone.jpg',
            'price' => '15.99',
        ]);

        Book::create([
            'user_id' => $user1->id,
            'author_id' => $king->id,
            'genre_id' => $horror->id,
            'title' => 'It',
            'slug' => 'it',
            'description' => 'A group of children faces a terrifying entity that preys on their fears.',
            'image' => 'images/it.jpg',
            'price' => '18.50',
        ]);

        Book::create([
            'user_id' => $user2->id,
            'author_id' => $austen->id,
            'genre_id' => $romance->id,
            'title' => 'Pride and Prejudice',
            'slug' => 'pride-and-prejudice',
            'description' => 'A witty exploration of love, class, and marriage in early 19th-century England.',
            'image' => 'images/pride-and-prejudice.jpg',
            'price' => '9.99',
        ]);

        Book::create([
            'user_id' => $user3->id,
            'author_id' => $rowling->id,
            'genre_id' => $fantasy->id,
            'title' => 'Harry Potter and the Chamber of Secrets',
            'slug' => 'harry-potter-2',
            'description' => 'Harry returns to Hogwarts for his second year and encounters a deadly mystery.',
            'image' => 'images/harry-potter-chamber.jpg',
            'price' => '16.99',
        ]);

        Book::create([
            'user_id' => $chris->id,
            'author_id' => $king->id,
            'genre_id' => $horror->id,
            'title' => 'The Shining',
            'slug' => 'the-shining',
            'description' => 'A family stays in a haunted hotel, where the father succumbs to madness.',
            'image' => 'images/the-shining.jpg',
            'price' => '12.99',
        ]);

        Book::create([
            'user_id' => $pablo->id,
            'author_id' => $tolkien->id,
            'genre_id' => $fantasy->id,
            'title' => 'The Lord of the Rings: The Fellowship of the Ring',
            'slug' => 'the-lord-of-the-rings-1',
            'description' => 'The first part of the epic quest to destroy a powerful ring and defeat a dark lord.',
            'image' => 'images/lord-of-the-rings-fellowship.jpg',
            'price' => '20.99',
        ]);

        Book::create([
            'user_id' => $user1->id,
            'author_id' => $austen->id,
            'genre_id' => $romance->id,
            'title' => 'Emma',
            'slug' => 'emma',
            'description' => 'The story of a young woman trying to play matchmaker in her village.',
            'image' => 'images/emma.jpg',
            'price' => '11.99',
        ]);

        Book::create([
            'user_id' => $user2->id,
            'author_id' => $king->id,
            'genre_id' => $horror->id,
            'title' => 'Carrie',
            'slug' => 'carrie',
            'description' => 'A bullied girl discovers she has telekinetic powers that will change her life forever.',
            'image' => 'images/carrie.jpg',
            'price' => '14.99',
        ]);

        Book::create([
            'user_id' => $user3->id,
            'author_id' => $rowling->id,
            'genre_id' => $fantasy->id,
            'title' => 'Harry Potter and the Prisoner of Azkaban',
            'slug' => 'harry-potter-3',
            'description' => 'Harry returns for his third year at Hogwarts and confronts a dangerous fugitive.',
            'image' => 'images/harry-potter-azkaban.jpg',
            'price' => '17.99',
        ]);

        Book::create([
            'user_id' => $chris->id,
            'author_id' => $austen->id,
            'genre_id' => $romance->id,
            'title' => 'Sense and Sensibility',
            'slug' => 'sense-and-sensibility',
            'description' => 'Two sisters navigate love and loss in early 19th-century England.',
            'image' => 'images/sense-and-sensibility.jpg',
            'price' => '10.49',
        ]);

        Book::create([
            'user_id' => $pablo->id,
            'author_id' => $king->id,
            'genre_id' => $thriller->id,
            'title' => 'Misery',
            'slug' => 'misery',
            'description' => 'A famous author is held captive by a fan after a car accident.',
            'image' => 'images/misery.jpg',
            'price' => '13.99',
        ]);

        Book::create([
            'user_id' => $user1->id,
            'author_id' => $tolkien->id,
            'genre_id' => $fantasy->id,
            'title' => 'The Lord of the Rings: The Two Towers',
            'slug' => 'the-lord-of-the-rings-2',
            'description' => 'The second part of the epic journey to destroy the One Ring.',
            'image' => 'images/lord-of-the-rings-two-towers.jpg',
            'price' => '21.99',
        ]);

        Book::create([
            'user_id' => $user2->id,
            'author_id' => $rowling->id,
            'genre_id' => $fantasy->id,
            'title' => 'Harry Potter and the Goblet of Fire',
            'slug' => 'harry-potter-4',
            'description' => 'Harry competes in the Triwizard Tournament, facing life-threatening challenges.',
            'image' => 'images/harry-potter-goblet.jpg',
            'price' => '18.49',
        ]);

        Book::create([
            'user_id' => $user3->id,
            'author_id' => $king->id,
            'genre_id' => $horror->id,
            'title' => 'Pet Sematary',
            'slug' => 'pet-sematary',
            'description' => 'A family moves to a small town and discovers a cemetery that brings things back from the dead.',
            'image' => 'images/pet-sematary.jpg',
            'price' => '16.99',
        ]);
        Book::create([
            'user_id' => $chris->id,
            'author_id' => $hemingway->id,
            'genre_id' => $literaryFiction->id,
            'title' => 'The Old Man and the Sea',
            'slug' => 'the-old-man-and-the-sea',
            'description' => 'A fisherman battles a giant marlin in the Gulf Stream, symbolizing his struggle against the forces of nature.',
            'image' => 'images/the-old-man-and-the-sea.jpg',
            'price' => '12.99',
        ]);

        Book::create([
            'user_id' => $pablo->id,
            'author_id' => $orwell->id,
            'genre_id' => $dystopian->id,
            'title' => '1984',
            'slug' => '1984',
            'description' => 'A man lives in a totalitarian society where his every move is watched, and he begins to question his world.',
            'image' => 'images/1984.jpg',
            'price' => '14.99',
        ]);

        Book::create([
            'user_id' => $user1->id,
            'author_id' => $fitzgerald->id,
            'genre_id' => $literaryFiction->id,
            'title' => 'The Great Gatsby',
            'slug' => 'the-great-gatsby',
            'description' => 'A mysterious millionaire, Jay Gatsby, tries to win back his lost love amidst the glamour and excess of the 1920s.',
            'image' => 'images/the-great-gatsby.jpg',
            'price' => '16.99',
        ]);

        Book::create([
            'user_id' => $user2->id,
            'author_id' => $dickens->id,
            'genre_id' => $historicalFiction->id,
            'title' => 'A Tale of Two Cities',
            'slug' => 'a-tale-of-two-cities',
            'description' => 'Set during the French Revolution, it explores the themes of resurrection and the effects of tyranny.',
            'image' => 'images/a-tale-of-two-cities.jpg',
            'price' => '13.50',
        ]);

        Book::create([
            'user_id' => $user3->id,
            'author_id' => $hemingway->id,
            'genre_id' => $literaryFiction->id,
            'title' => 'A Farewell to Arms',
            'slug' => 'a-farewell-to-arms',
            'description' => 'The love story between an American ambulance driver and a British nurse during World War I.',
            'image' => 'images/a-farewell-to-arms.jpg',
            'price' => '14.00',
        ]);

        Book::create([
            'user_id' => $chris->id,
            'author_id' => $orwell->id,
            'genre_id' => $dystopian->id,
            'title' => 'Animal Farm',
            'slug' => 'animal-farm',
            'description' => 'A group of farm animals rebel against their human owner, only to find themselves under the control of a tyrannical leader.',
            'image' => 'images/animal-farm.jpg',
            'price' => '10.99',
        ]);

        Book::create([
            'user_id' => $pablo->id,
            'author_id' => $fitzgerald->id,
            'genre_id' => $literaryFiction->id,
            'title' => 'Tender is the Night',
            'slug' => 'tender-is-the-night',
            'description' => 'A tragic tale of a glamorous couple’s disintegration as their lives spiral into decadence and despair.',
            'image' => 'images/tender-is-the-night.jpg',
            'price' => '17.99',
        ]);

        Book::create([
            'user_id' => $user1->id,
            'author_id' => $dickens->id,
            'genre_id' => $historicalFiction->id,
            'title' => 'Great Expectations',
            'slug' => 'great-expectations',
            'description' => 'A young orphan named Pip struggles to rise above his circumstances, encountering fascinating characters along the way.',
            'image' => 'images/great-expectations.jpg',
            'price' => '13.25',
        ]);

        Book::create([
            'user_id' => $user2->id,
            'author_id' => $hemingway->id,
            'genre_id' => $literaryFiction->id,
            'title' => 'For Whom the Bell Tolls',
            'slug' => 'for-whom-the-bell-tolls',
            'description' => 'A story about an American soldier during the Spanish Civil War, facing the brutality of war and his own inner conflicts.',
            'image' => 'images/for-whom-the-bell-tolls.jpg',
            'price' => '15.50',
        ]);

        Book::create([
            'user_id' => $user3->id,
            'author_id' => $orwell->id,
            'genre_id' => $dystopian->id,
            'title' => 'Homage to Catalonia',
            'slug' => 'homage-to-catalonia',
            'description' => 'Orwell’s personal account of his experiences in the Spanish Civil War, with insights into the nature of revolution.',
            'image' => 'images/homage-to-catalonia.jpg',
            'price' => '12.50',
        ]);

        Book::create([
            'user_id' => $chris->id,
            'author_id' => $fitzgerald->id,
            'genre_id' => $literaryFiction->id,
            'title' => 'This Side of Paradise',
            'slug' => 'this-side-of-paradise',
            'description' => 'Fitzgerald’s first novel, a coming-of-age story that explores the generation of the post-World War I era.',
            'image' => 'images/this-side-of-paradise.jpg',
            'price' => '14.99',
        ]);

        Book::create([
            'user_id' => $pablo->id,
            'author_id' => $dickens->id,
            'genre_id' => $drama->id,
            'title' => 'Oliver Twist',
            'slug' => 'oliver-twist',
            'description' => 'The story of a young orphan who runs away from a workhouse and becomes entangled with a group of criminals.',
            'image' => 'images/oliver-twist.jpg',
            'price' => '11.99',
        ]);

        Book::create([
            'user_id' => $user1->id,
            'author_id' => $hemingway->id,
            'genre_id' => $literaryFiction->id,
            'title' => 'The Sun Also Rises',
            'slug' => 'the-sun-also-rises',
            'description' => 'The story of a group of expatriates living in Europe after World War I, reflecting on their disillusionment with society.',
            'image' => 'images/the-sun-also-rises.jpg',
            'price' => '13.99',
        ]);

        Book::create([
            'user_id' => $user2->id,
            'author_id' => $orwell->id,
            'genre_id' => $dystopian->id,
            'title' => 'Down and Out in Paris and London',
            'slug' => 'down-and-out-in-paris-and-london',
            'description' => 'Orwell’s early work about his experiences living in poverty in two major European cities.',
            'image' => 'images/down-and-out.jpg',
            'price' => '9.99',
        ]);

        Book::create([
            'user_id' => $user3->id,
            'author_id' => $fitzgerald->id,
            'genre_id' => $literaryFiction->id,
            'title' => 'The Last Tycoon',
            'slug' => 'the-last-tycoon',
            'description' => 'Fitzgerald’s unfinished novel about a Hollywood mogul, reflecting on fame, success, and personal ambition.',
            'image' => 'images/the-last-tycoon.jpg',
            'price' => '17.00',
        ]);
    }
}
