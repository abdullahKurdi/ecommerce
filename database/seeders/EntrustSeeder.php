<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //for fake data for customer
        $faker = Factory::create();

        //*************Role seeder*************
        $adminRole      = Role::create([
            'name'          =>  'admin',
            'display_name'  =>  'Administration',
            'description'   =>  'Administration',
            'allowed_route' =>  'admin',
        ]);
        $supervisorRole = Role::create([
            'name'          =>  'supervisor',
            'display_name'  =>  'Supervisor',
            'description'   =>  'Supervisor',
            'allowed_route' =>  'admin',
        ]);
        $customerRole   = Role::create([
            'name'          =>  'customer',
            'display_name'  =>  'Customer',
            'description'   =>  'Customer',
            'allowed_route' =>  null,
        ]);


        //*************User seeder******************
        //Add admin user
        $admin = User::create([
            'first_name'        =>  'Admin',
            'last_name'         =>  'System',
            'username'          =>  'admin',
            'email'             =>  'admin@ecommerce.potato',
            'email_verified_at' =>  now(),
            'mobile'            =>  '962775772008',
            'user_image'        =>  'avatar.svg',
            'password'          =>  bcrypt('123456789'),
            'status'            =>  1,
            'remember_token'    =>  Str::random(10),
        ]);
        //Add role for admin
        $admin->attachRole($adminRole);

        //Add supervisor user
        $supervisor = User::create([
            'first_name'        =>  'Supervisor',
            'last_name'         =>  'System',
            'username'          =>  'supervisor',
            'email'             =>  'supervisor@ecommerce.potato',
            'email_verified_at' =>  now(),
            'mobile'            =>  '962775772009',
            'user_image'        =>  'avatar.svg',
            'password'          =>  bcrypt('123456789'),
            'status'            =>  1,
            'remember_token'    =>  Str::random(10),
        ]);
        //Add role for supervisor
        $supervisor->attachRole($supervisorRole);

        //Add customer user
        $customer = User::create([
            'first_name'        =>  'Customer',
            'last_name'         =>  'System',
            'username'          =>  'customer',
            'email'             =>  'customer@ecommerce.potato',
            'email_verified_at' =>  now(),
            'mobile'            =>  '962775772010',
            'user_image'        =>  'avatar.svg',
            'password'          =>  bcrypt('123456789'),
            'status'            =>  1,
            'remember_token'    =>  Str::random(10),
        ]);
        //Add role for customer
        $customer->attachRole($customerRole);

        //Add many customer
        for ($i = 1 ; $i <= 25 ; $i++){
            $randomCustomer = User::create([
                'first_name'        =>  $faker->firstName,
                'last_name'         =>  $faker->lastName,
                'username'          =>  $faker->userName,
                'email'             =>  $faker->unique()->safeEmail,
                'email_verified_at' =>  now(),
                'mobile'            =>  '96277'. $faker->numberBetween(1000000 , 9999999),
                'user_image'        =>  'avatar.svg',
                'password'          =>  bcrypt('123456789'),
                'status'            =>  1,
                'remember_token'    =>  Str::random(10),
            ]);

            $randomCustomer->attachRole($customerRole);
        }

        //Create seeder permission for main section in dashboard
        $manageMain = Permission::create([
            'name'              =>  'main',
            'display_name'      =>  'Main',
            'description'       =>  'Main',
            'route'             =>  'index',
            'module'            =>  'index',
            'as'                =>  'index',
            'icon'              =>  'fas fa-home',
            'parent'            =>  '0',
            'parent_original'   =>  '0',
            'sidebar_link'      =>  '1',
            'appear'            =>  '1',
            'ordering'          =>  '1',
        ]);
        $manageMain -> parent_show = $manageMain->id;
        $manageMain->save();

        //Create seeder permission for product category section in dashboard
        $manageProductCategories = Permission::create([
            'name'              =>  'manage_product_categories',
            'display_name'      =>  'Categories',
            'description'       =>  'Categories',
            'route'             =>  'product_categories',
            'module'            =>  'product_categories',
            'as'                =>  'product_categories.index',
            'icon'              =>  'fas fa-file-archive',
            'parent'            =>  '0',
            'parent_original'   =>  '0',
            'sidebar_link'      =>  '1',
            'appear'            =>  '1',
            'ordering'          =>  '5',
        ]);
        $manageProductCategories -> parent_show = $manageProductCategories->id;
        $manageProductCategories->save();

        //Create seeder permission for product category children section in dashboard
        $showProductCategories = Permission::create([
            'name'              =>  'show_product_categories',
            'display_name'      =>  'Categories',
            'description'       =>  'Categories',
            'route'             =>  'product_categories',
            'module'            =>  'product_categories',
            'as'                =>  'product_categories.index',
            'icon'              =>  'fas fa-file-archive',
            'parent'            =>  $manageProductCategories->id,
            'parent_show'       =>  $manageProductCategories->id,
            'parent_original'   =>  $manageProductCategories->id,
            'sidebar_link'      =>  '1',
            'appear'            =>  '1',

        ]);
        $createProductCategories = Permission::create([
            'name'              =>  'create_product_categories',
            'display_name'      =>  'Create Category',
            'description'       =>  'Create Category',
            'route'             =>  'product_categories',
            'module'            =>  'product_categories',
            'as'                =>  'product_categories.create',
            'icon'              =>  null,
            'parent'            =>  $manageProductCategories->id,
            'parent_show'       =>  $manageProductCategories->id,
            'parent_original'   =>  $manageProductCategories->id,
            'sidebar_link'      =>  '1',
            'appear'            =>  '0',

        ]);
        $displayProductCategories = Permission::create([
            'name'              =>  'display_product_categories',
            'display_name'      =>  'Display Category',
            'description'       =>  'Display Category',
            'route'             =>  'product_categories',
            'module'            =>  'product_categories',
            'as'                =>  'product_categories.show',
            'icon'              =>  null,
            'parent'            =>  $manageProductCategories->id,
            'parent_show'       =>  $manageProductCategories->id,
            'parent_original'   =>  $manageProductCategories->id,
            'sidebar_link'      =>  '1',
            'appear'            =>  '0',

        ]);
        $updateProductCategories = Permission::create([
            'name'              =>  'update_product_categories',
            'display_name'      =>  'Update Category',
            'description'       =>  'Update Category',
            'route'             =>  'product_categories',
            'module'            =>  'product_categories',
            'as'                =>  'product_categories.edit',
            'icon'              =>  null,
            'parent'            =>  $manageProductCategories->id,
            'parent_show'       =>  $manageProductCategories->id,
            'parent_original'   =>  $manageProductCategories->id,
            'sidebar_link'      =>  '1',
            'appear'            =>  '0',

        ]);
        $deleteProductCategories = Permission::create([
            'name'              =>  'delete_product_categories',
            'display_name'      =>  'Delete Category',
            'description'       =>  'Delete Category',
            'route'             =>  'product_categories',
            'module'            =>  'product_categories',
            'as'                =>  'product_categories.destroy',
            'icon'              =>  null,
            'parent'            =>  $manageProductCategories->id,
            'parent_show'       =>  $manageProductCategories->id,
            'parent_original'   =>  $manageProductCategories->id,
            'sidebar_link'      =>  '1',
            'appear'            =>  '0',

        ]);



        //Create seeder permission for store product section in dashboard
        $manageProducts = Permission::create([
            'name'              =>  'manage_products',
            'display_name'      =>  'products',
            'description'       =>  'products',
            'route'             =>  'products',
            'module'            =>  'products',
            'as'                =>  'products.index',
            'icon'              =>  'fas fa-shopping-basket',
            'parent'            =>  '0',
            'parent_original'   =>  '0',
            'sidebar_link'      =>  '1',
            'appear'            =>  '1',
            'ordering'          =>  '10',
        ]);
        $manageProducts -> parent_show = $manageProducts->id;
        $manageProducts->save();

        //Create seeder permission for product children section in dashboard
        $showProducts = Permission::create([
            'name'              =>  'show_products',
            'display_name'      =>  'Products',
            'description'       =>  'Products',
            'route'             =>  'products',
            'module'            =>  'products',
            'as'                =>  'products.index',
            'icon'              =>  'fas fa-file-archive',
            'parent'            =>  $manageProducts->id,
            'parent_show'       =>  $manageProducts->id,
            'parent_original'   =>  $manageProducts->id,
            'sidebar_link'      =>  '1',
            'appear'            =>  '1',

        ]);
        $createProducts = Permission::create([
            'name'              =>  'create_products',
            'display_name'      =>  'Create Products',
            'description'       =>  'Create Products',
            'route'             =>  'products',
            'module'            =>  'products',
            'as'                =>  'products.create',
            'icon'              =>  null,
            'parent'            =>  $manageProducts->id,
            'parent_show'       =>  $manageProducts->id,
            'parent_original'   =>  $manageProducts->id,
            'sidebar_link'      =>  '1',
            'appear'            =>  '0',

        ]);
        $displayProducts = Permission::create([
            'name'              =>  'display_products',
            'display_name'      =>  'Display Products',
            'description'       =>  'Display Products',
            'route'             =>  'products',
            'module'            =>  'products',
            'as'                =>  'products.show',
            'icon'              =>  null,
            'parent'            =>  $manageProducts->id,
            'parent_show'       =>  $manageProducts->id,
            'parent_original'   =>  $manageProducts->id,
            'sidebar_link'      =>  '1',
            'appear'            =>  '0',

        ]);
        $updateProducts = Permission::create([
            'name'              =>  'update_products',
            'display_name'      =>  'Update Products',
            'description'       =>  'Update Products',
            'route'             =>  'products',
            'module'            =>  'products',
            'as'                =>  'products.edit',
            'icon'              =>  null,
            'parent'            =>  $manageProducts->id,
            'parent_show'       =>  $manageProducts->id,
            'parent_original'   =>  $manageProducts->id,
            'sidebar_link'      =>  '1',
            'appear'            =>  '0',

        ]);
        $deleteProducts = Permission::create([
            'name'              =>  'delete_products',
            'display_name'      =>  'Delete Products',
            'description'       =>  'Delete Products',
            'route'             =>  'products',
            'module'            =>  'products',
            'as'                =>  'products.destroy',
            'icon'              =>  null,
            'parent'            =>  $manageProducts->id,
            'parent_show'       =>  $manageProducts->id,
            'parent_original'   =>  $manageProducts->id,
            'sidebar_link'      =>  '1',
            'appear'            =>  '0',

        ]);



        //Create seeder permission for store tags section in dashboard
        $manageTags = Permission::create([
            'name'              =>  'manage_tags',
            'display_name'      =>  'Tags',
            'description'       =>  'Tags',
            'route'             =>  'tags',
            'module'            =>  'tags',
            'as'                =>  'tags.index',
            'icon'              =>  'fas fa-tags',
            'parent'            =>  '0',
            'parent_original'   =>  '0',
            'sidebar_link'      =>  '1',
            'appear'            =>  '1',
            'ordering'          =>  '10',
        ]);
        $manageTags -> parent_show = $manageTags->id;
        $manageTags->save();

        //Create seeder permission for Tags children section in dashboard
        $showTags = Permission::create([
            'name'              =>  'show_tags',
            'display_name'      =>  'Tags',
            'description'       =>  'Tags',
            'route'             =>  'tags',
            'module'            =>  'tags',
            'as'                =>  'tags.index',
            'icon'              =>  'fas fa-file-archive',
            'parent'            =>  $manageTags->id,
            'parent_show'       =>  $manageTags->id,
            'parent_original'   =>  $manageTags->id,
            'sidebar_link'      =>  '1',
            'appear'            =>  '1',

        ]);
        $createTags = Permission::create([
            'name'              =>  'create_tags',
            'display_name'      =>  'Create Tags',
            'description'       =>  'Create Tags',
            'route'             =>  'tags',
            'module'            =>  'tags',
            'as'                =>  'tags.create',
            'icon'              =>  null,
            'parent'            =>  $manageTags->id,
            'parent_show'       =>  $manageTags->id,
            'parent_original'   =>  $manageTags->id,
            'sidebar_link'      =>  '1',
            'appear'            =>  '0',

        ]);
        $displayTags = Permission::create([
            'name'              =>  'display_tags',
            'display_name'      =>  'Display Tags',
            'description'       =>  'Display Tags',
            'route'             =>  'tags',
            'module'            =>  'tags',
            'as'                =>  'tags.show',
            'icon'              =>  null,
            'parent'            =>  $manageTags->id,
            'parent_show'       =>  $manageTags->id,
            'parent_original'   =>  $manageTags->id,
            'sidebar_link'      =>  '1',
            'appear'            =>  '0',

        ]);
        $updateTags = Permission::create([
            'name'              =>  'update_tags',
            'display_name'      =>  'Update Tags',
            'description'       =>  'Update Tags',
            'route'             =>  'tags',
            'module'            =>  'tags',
            'as'                =>  'tags.edit',
            'icon'              =>  null,
            'parent'            =>  $manageTags->id,
            'parent_show'       =>  $manageTags->id,
            'parent_original'   =>  $manageTags->id,
            'sidebar_link'      =>  '1',
            'appear'            =>  '0',

        ]);
        $deleteTags = Permission::create([
            'name'              =>  'delete_tags',
            'display_name'      =>  'Delete Tags',
            'description'       =>  'Delete Tags',
            'route'             =>  'tags',
            'module'            =>  'tags',
            'as'                =>  'tags.destroy',
            'icon'              =>  null,
            'parent'            =>  $manageTags->id,
            'parent_show'       =>  $manageTags->id,
            'parent_original'   =>  $manageTags->id,
            'sidebar_link'      =>  '1',
            'appear'            =>  '0',

        ]);

    }
}
