<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Bookshelf_item;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::factory()->count(10)->create()->each(function ($book) {
            $author = Author::factory()->make();
            $book->authors()->save($author);

            $category = Category::factory()->make();
            $book->categories()->save($category);

            $bookshelf_item = Bookshelf_item::factory()->make();
            $book->bookshelf_items()->save($bookshelf_item);

        });
    }
}
