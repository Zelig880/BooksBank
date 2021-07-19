<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'thumbnail', 'ISBN'];

    /**
     * The categories that belong to the book.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * The authors that belong to the book.
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    /**
     * The bookshelf items that belong to the book.
     */
    public function bookshelf_item()
    {
        return $this->belongsToMany(Bookshelf_item::class);
    }

    public static function add($item, $bookshelf_id)
    {
        $book = Book::query()->firstOrCreate([
            'title' => $item['title'],
            'ISBN' => $item['ISBN'],
        ], [
            'description' => $item['description'],
            'thumbnail' => $item['thumbnail'],
        ]);

        if (is_array($item['categories']) && count($item['categories']) > 0)
        {
            foreach ($item['categories'] as $key => $value) {
                $book->categories()->updateOrCreate([
                    'name' => $value
                ],[
                    'name' => $value
                ]);
            }
        }

        if (is_array($item['authors']) && count($item['authors']) > 0)
        {
            foreach ($item['authors'] as $key => $value) {
                $book->authors()->updateOrCreate([
                    'name' => $value
                ],[
                    'name' => $value
                ]);
            }
        }

        $book->bookshelf_item()->create([
            'condition' => $item['condition'],
            'status' => $item['status'],
            'type' => $item['type'],
            'bookshelf_id' => $bookshelf_id,
            'book_id' => $book->id
        ]);
    }

}
