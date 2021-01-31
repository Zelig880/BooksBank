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
            'delivery' => 2,    
        ]);
        DB::table('bookshelves')->insert([
            'user_id' => 2,
            'longitude' => -3.8518577,
            'latitude' => 51.7197665,
            'delivery' => 1,    
        ]);
    }
}
