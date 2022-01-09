<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //*********** Create Product Category **********

        //Parent Category Named Clothes
        $clothes = ProductCategory::create([
            'name'          =>'Clothes',
            'cover'         =>'clothes.jpg',
            'status'        =>true,
            'parent_id'     =>null,
        ]);

        //Children Category Of Clothes
        ProductCategory::create([
            'name'          =>'Women\'s T-Shirts',
            'cover'         =>'clothes.jpg',
            'status'        =>true,
            'parent_id'     =>$clothes->id,
        ]);
        ProductCategory::create([
            'name'          =>'Men\'s T-Shirts',
            'cover'         =>'clothes.jpg',
            'status'        =>true,
            'parent_id'     =>$clothes->id,
        ]);
        ProductCategory::create([
            'name'          =>'Women\'s Sunglasses',
            'cover'         =>'clothes.jpg',
            'status'        =>true,
            'parent_id'     =>$clothes->id,
        ]);
        ProductCategory::create([
            'name'          =>'Men\'s Sunglasses',
            'cover'         =>'clothes.jpg',
            'status'        =>true,
            'parent_id'     =>$clothes->id,
        ]);


        //Parent Category Named Shoes
        $shoes = ProductCategory::create([
            'name'          =>'Shoes',
            'cover'         =>'shoes.jpg',
            'status'        =>true,
            'parent_id'     =>null,
        ]);

        //Children Category Of Shoes
        ProductCategory::create([
            'name'          =>'Women\'s Shoes',
            'cover'         =>'shoes.jpg',
            'status'        =>true,
            'parent_id'     =>$shoes->id,
        ]);
        ProductCategory::create([
            'name'          =>'Men\'s Shoes',
            'cover'         =>'shoes.jpg',
            'status'        =>true,
            'parent_id'     =>$shoes->id,
        ]);
        ProductCategory::create([
            'name'          =>'Boy\'s Shoes',
            'cover'         =>'shoes.jpg',
            'status'        =>true,
            'parent_id'     =>$shoes->id,
        ]);
        ProductCategory::create([
            'name'          =>'Girls\'s Shoes',
            'cover'         =>'shoes.jpg',
            'status'        =>true,
            'parent_id'     =>$shoes->id,
        ]);


        //Parent Category Named Watches
        $watches = ProductCategory::create([
            'name'          =>'Watches',
            'cover'         =>'watches.jpg',
            'status'        =>true,
            'parent_id'     =>null,
        ]);

        //Children Category Of Watches
        ProductCategory::create([
            'name'          =>'Women\'s Watches',
            'cover'         =>'watches.jpg',
            'status'        =>true,
            'parent_id'     =>$watches->id,
        ]);
        ProductCategory::create([
            'name'          =>'Men\'s Watches',
            'cover'         =>'watches.jpg',
            'status'        =>true,
            'parent_id'     =>$watches->id,
        ]);
        ProductCategory::create([
            'name'          =>'Boy\'s Watches',
            'cover'         =>'watches.jpg',
            'status'        =>true,
            'parent_id'     =>$watches->id,
        ]);
        ProductCategory::create([
            'name'          =>'Girls\'s Watches',
            'cover'         =>'watches.jpg',
            'status'        =>true,
            'parent_id'     =>$watches->id,
        ]);
    }
}
