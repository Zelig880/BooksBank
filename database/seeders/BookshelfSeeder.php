<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BookshelfSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Model::unguard();

        $bookshelves = [
            [
                'user_id' => 1,
                'longitude' => -3.9823859,
                'latitude' => 51.6075778,
                'opening_days' => \GuzzleHttp\json_encode($this->generateArrayOfRandomNumbers(1, 30)),
                'opening_hours' => \GuzzleHttp\json_encode($this->generateArrayOfRandomNumbers()),
                'address_line_1' => $faker->address,
                'city' => $faker->city,
                'postcode' => $faker->postcode,
                'delivery' => 2,
            ], [
                'user_id' => 2,
                'longitude' => -3.8518577,
                'latitude' => 51.7197665,
                'opening_days' => \GuzzleHttp\json_encode($this->generateArrayOfRandomNumbers(1, 30)),
                'opening_hours' => \GuzzleHttp\json_encode($this->generateArrayOfRandomNumbers()),
                'address_line_1' => $faker->address,
                'city' => $faker->city,
                'postcode' => $faker->postcode,
                'delivery' => 1,
            ], [
                'user_id' => 3,
                'longitude' => -4.8518577,
                'latitude' => 58.7197665,
                'opening_days' => \GuzzleHttp\json_encode($this->generateArrayOfRandomNumbers(1, 30)),
                'opening_hours' => \GuzzleHttp\json_encode($this->generateArrayOfRandomNumbers()),
                'address_line_1' => $faker->address,
                'city' => $faker->city,
                'postcode' => $faker->postcode,
                'delivery' => 1,
            ]
        ];

        Model::reguard();

//        DB::table('bookshelves')->truncate();
        DB::table('bookshelves')->insert($bookshelves);
    }

    private function generateArrayOfRandomNumbers(int $lowerBound = 1, int $upperBound = 24)
    {
        $random = [];
        for ($i = 0; $i < 4; $i++)
        {
            $random[] = rand($lowerBound, $upperBound);
        }

        return $random;
    }
}
