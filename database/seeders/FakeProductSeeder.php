<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();


        $products = [];
        $products [] = DB::table("products")->insertGetId([
            "mootanroo_id"  => 112662,
            "name" => 'روغن مو اوریفلیم سری لاونیچر مناسب موهای خشک و آسیب دیده حجم 15 میل - شماره 32620',
            "price" => 60000,
            "media_url" => "/assets/pictures/sample-product.jpg"
        ]);

        $products [] = DB::table("products")->insertGetId([
            "mootanroo_id"  => 133319,
            "name" => 'دستگاه فشارسنج بازویی دیجیتال رزمکس مدل CH155',
            "price" => 840000,
            "media_url" => "/assets/pictures/sample-product.jpg"
        ]);

        $products [] = DB::table("products")->insertGetId([
            "mootanroo_id"  => 186784,
            "name" => 'ماشین اصلاح صورت مک استایلر مدل MC5810',
            "price" => 1246500,
            "media_url" => "/assets/pictures/sample-product.jpg"
        ]);

        $products [] = DB::table("products")->insertGetId([
            "mootanroo_id"  => 124409,
            "name" => 'پد پاک کننده آرایش میکاپ رز بسته 92 عددی',
            "price" => 36000,
            "media_url" => "/assets/pictures/sample-product.jpg"
        ]);

        $products [] = DB::table("products")->insertGetId([
            "mootanroo_id"  => 141564,
            "name" => 'اسکراب بدن تاپ شاپ حاوی روغن آرگان حجم 200 میل',
            "price" => 42840,
            "media_url" => "/assets/pictures/sample-product.jpg"
        ]);

        $products [] = DB::table("products")->insertGetId([
            "mootanroo_id"  => 66545,
            "name" => 'ماسک ضد چروک و سفت کننده صورت هیدرودرم حاوی Q10 حجم 100 میل',
            "price" => 149625,
            "media_url" => "/assets/pictures/sample-product.jpg"
        ]);
        


        foreach($products as $product){
            DB::table('product_seller')->insert([
                'product_id' => $product,
                'seller_id' => 4,
                'quantity' => $faker->randomNumber(1),
            ]);
        }
        

    }
}
