<?php

namespace Webkul\LeadPerson\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Path= php artisan db:seed --class="Webkul\\LeadPerson\\Database\\Seeders\\LeadPersonAttributeSeeder
 */
class LeadPersonAttributeSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $attributes = [
            [
                'code'            => 'service_type',
                'name'            => 'Service Type',
                'type'            => 'select',
                'entity_type'     => 'persons',
                'lookup_type'     => NULL,
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => NULL,
                'quick_add'       => '1',
                'is_user_defined' => '1',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'vehicle_type',
                'name'            => 'Vehicle Type',
                'type'            => 'select',
                'entity_type'     => 'persons',
                'lookup_type'     => NULL,
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => NULL,
                'quick_add'       => '1',
                'is_user_defined' => '1',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'pickup_date',
                'name'            => 'Pickup Date',
                'type'            => 'date',
                'entity_type'     => 'persons',
                'lookup_type'     => NULL,
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => NULL,
                'quick_add'       => '1',
                'is_user_defined' => '1',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'pickup_time',
                'name'            => 'Pickup Time',
                'type'            => 'time',
                'entity_type'     => 'persons',
                'lookup_type'     => NULL,
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => NULL,
                'quick_add'       => '1',
                'is_user_defined' => '1',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'pickup_location',
                'name'            => 'Pickup Location',
                'type'            => 'text',
                'entity_type'     => 'persons',
                'lookup_type'     => NULL,
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => NULL,
                'quick_add'       => '1',
                'is_user_defined' => '1',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'drop_location',
                'name'            => 'Drop Location',
                'type'            => 'text',
                'entity_type'     => 'persons',
                'lookup_type'     => NULL,
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => NULL,
                'quick_add'       => '1',
                'is_user_defined' => '1',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'pickup_airport',
                'name'            => 'Pickup Airport',
                'type'            => 'text',
                'entity_type'     => 'persons',
                'lookup_type'     => NULL,
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => NULL,
                'quick_add'       => '1',
                'is_user_defined' => '1',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'dropoff_airport',
                'name'            => 'Dropoff Airport',
                'type'            => 'text',
                'entity_type'     => 'persons',
                'lookup_type'     => NULL,
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => NULL,
                'quick_add'       => '1',
                'is_user_defined' => '1',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
        ];

        DB::table('attributes')->insert($attributes);

        $serviceTypeId = DB::table('attributes')->where('code', 'service_type')->first()->id;

        $vehicleTypeId = DB::table('attributes')->where('code', 'vehicle_type')->first()->id;

        DB::table('attribute_options')->delete();

        $options = [
            [
                'attribute_id'    => $serviceTypeId,
                'name'            => 'One Way Trip to Airport',
            ], [
                'attribute_id'    => $serviceTypeId,
                'name'            => 'One Way Trip From Airport',
            ], [
                'attribute_id'    => $serviceTypeId,
                'name'            => 'Round Trip to Airport',
            ], [
                'attribute_id'    => $serviceTypeId,
                'name'            => 'Round Trip From Airport',
            ], [
                'attribute_id'    => $serviceTypeId,
                'name'            => 'One way Trip Point to Point',
            ], [
                'attribute_id'    => $serviceTypeId,
                'name'            => 'Round Trip Point to Point',
            ], [
                'attribute_id'    => $serviceTypeId,
                'name'            => 'Hourly Service',
            ], [
                'attribute_id'    => $vehicleTypeId,
                'name'            => 'Pick-Up',
            ],[
                'attribute_id'    => $vehicleTypeId,
                'name'            => 'Sedan',
            ], [
                'attribute_id'    => $vehicleTypeId,
                'name'            => 'SUV',
            ], [
                'attribute_id'    => $vehicleTypeId,
                'name'            => 'Track',
            ], [
                'attribute_id'    => $vehicleTypeId,
                'name'            => 'VIP car',
            ],
        ];

        DB::table('attribute_options')->insert($options);
    }
}
