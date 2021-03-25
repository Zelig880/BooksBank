<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class BookshelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookshelves')->insert([
            'user_id' => 1,
            'longitude' => -3.9823859,
            'latitude' => 51.6075778,
            'pickup_times' => '[1,2,3]',
            'delivery' => 2,
        ]);
        DB::table('bookshelves')->insert([
            'user_id' => 2,
            'longitude' => -3.8518577,
            'latitude' => 51.7197665,
            'pickup_times' => '[25,45,12,44,13,2,0,5]',
            'delivery' => 1,    
        ]);
        DB::table('bookshelves')->insert([
            'user_id' => 3,
            'longitude' => -4.8518577,
            'latitude' => 58.7197665,
            'delivery' => 1,    
        ]);
    }
}
