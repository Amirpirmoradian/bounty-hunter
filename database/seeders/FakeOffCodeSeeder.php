<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakeOffCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<=1000; $i++){
            $faker = \Faker\Factory::create();

            DB::table("off_codes")->insert([
                "code" => 'dashti-' . explode('-', $faker->Uuid())[0],
                "seller_id" => 4,
            ]);
        }
    }
}
