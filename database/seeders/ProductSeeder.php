<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Schema::enableForeignKeyConstraints();

        $products = [
            'Pizza margherita', 'Hamburger', 'Cheeseburger', 'Lasagne', 'Polenta',
            'Calzone farcito', 'Insalata di pollo', 'Pizza capricciosa', 'Sgombro al forno',
            'Panino vegano', 'Panino vegetariano al formaggio', 'Formaggio grigliato', 'Torta paradiso', 'Tiramisù', 'Hot Dog', 'Caprese', 'Spaghetti al ragù'
        ];

        $typologies = ['panini', 'bevanda', 'dessert', 'pizza', 'sushi', 'vegetariano', 'alcolici'];
        

        foreach (Restaurant::all() as $restaurant) {
            for ($i = 0; $i < 5; $i++) {

                $new_product = new Product();
                $new_product->name = $products[rand(0, count($products) - 1)];
                $new_product->is_available = $faker->numberBetween(0, 1);
                $new_product->image = $faker->imageUrl(640, 480, 'food', true);
                $new_product->typology = $typologies[rand(0, count($typologies) - 1)];
                $new_product->description = $faker->paragraph(2);
                $new_product->ingredients = $faker->paragraph(1);
                $new_product->price = $faker->numerify('##.##');
                $new_product->restaurant_id = $restaurant->id;
                $new_product->save();
            }
        }
    }
}
