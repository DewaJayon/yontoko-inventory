<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        $imagePath = Storage::path('products');

        if (!file_exists($imagePath)) {
            mkdir($imagePath, 0777, true);
        }


        for ($i = 0; $i < 20; $i++) {

            $imageSource = Http::get('https://picsum.photos/1080/1080?random');

            $image = $imageSource->body();

            $imageName = $i . '.jpg';

            Storage::put('products/' . $imageName, $image);


            Product::create([
                'category_id'   => $faker->numberBetween(1, 10),
                'slug'          => $faker->slug,
                'name'          => $faker->name,
                'description'   => $faker->text(200),
                'image'         => 'products/' . $imageName,
                'code'          => $faker->ean13,
                'qty'           => $faker->numberBetween(10, 100),
                'price'         => $faker->numberBetween(10000, 100000),
                'stock_alert'   => $faker->numberBetween(10, 20),
                'status'        => $faker->numberBetween(0, 1),
            ]);
        }
    }
}
