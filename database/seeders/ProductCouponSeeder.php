<?php

namespace Database\Seeders;

use App\Models\ProductCoupon;
use Carbon\Carbon;
use Illuminate\Database\Seeder;


class ProductCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCoupon::create([
            'code'=>'abdullah1998',
            'type'=>'fixed',
            'value'=>200,
            'description'=>'coupon description',
            'use_times'=>20,
            'start_date'=>Carbon::now(),
            'expire_date'=>Carbon::now()->addMonth(),
            'greater_than'=>600,
            'status'=>true,

        ]);

        ProductCoupon::create([
            'code'=>'mohammed1998',
            'type'=>'percentage',
            'value'=>10,
            'description'=>'coupon description',
            'use_times'=>1000,
            'start_date'=>Carbon::now(),
            'expire_date'=>Carbon::now()->addMonth(),
            'greater_than'=>150,
            'status'=>true,

        ]);
        ProductCoupon::create([
            'code'=>'fafafa',
            'type'=>'fixed',
            'value'=>300,
            'description'=>'coupon description',
            'use_times'=>20,
            'start_date'=>Carbon::now(),
            'expire_date'=>Carbon::now()->addMonth(),
            'greater_than'=>null,
            'status'=>true,
        ]);
    }
}
