<?php
namespace Database\Factories;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence($nbWords = 4),
            'description' => $this->faker->text($maxNbChars = 200),
            'ISBN' => $this->faker->isbn13,
            'thumbnail' => $this->faker->imageUrl($width = 640, $height = 480),
        ];
    }
}

