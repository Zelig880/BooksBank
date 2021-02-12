<?php
namespace Database\Factories;

use App\Models\Bookshelf_item;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class Bookshelf_itemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bookshelf_item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'book_id' => $this->faker->numberBetween($min = 1, $max = 20),
            'bookshelf_id' => $this->faker->numberBetween($min = 1, $max = 2),
            'condition' => $this->faker->randomElement($array = array (0,1,2)),
            'status' => $this->faker->randomElement($array = array (0,1,2))
        ];
    }
}

