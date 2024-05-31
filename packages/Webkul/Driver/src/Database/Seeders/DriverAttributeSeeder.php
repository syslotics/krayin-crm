<?php

namespace Webkul\Driver\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Path= php artisan db:seed --class="Webkul\\Driver\\Database\\Seeders\\DriverAttributeSeeder
 */
class DriverAttributeSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $attributes = [
            [
                'code'            => 'name',
                'name'            => 'Name',
                'type'            => 'text',
                'entity_type'     => 'drivers',
                'lookup_type'     => NULL,
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => NULL,
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'phone',
                'name'            => 'Phone',
                'type'            => 'phone',
                'entity_type'     => 'drivers',
                'lookup_type'     => 'leads',
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => NULL,
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'email',
                'name'            => 'Email',
                'type'            => 'email',
                'entity_type'     => 'drivers',
                'lookup_type'     => 'leads',
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => NULL,
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'tax',
                'name'            => 'Tax',
                'type'            => 'price',
                'entity_type'     => 'drivers',
                'lookup_type'     => 'leads',
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => NULL,
                'quick_add'       => '1',
                'is_user_defined' => '1',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'gratuity',
                'name'            => 'Gratuity',
                'type'            => 'price',
                'entity_type'     => 'drivers',
                'lookup_type'     => 'leads',
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => NULL,
                'quick_add'       => '1',
                'is_user_defined' => '1',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'extra_addons',
                'name'            => 'Extra Addons',
                'type'            => 'price',
                'entity_type'     => 'drivers',
                'lookup_type'     => 'leads',
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => NULL,
                'quick_add'       => '1',
                'is_user_defined' => '1',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'total_cost',
                'name'            => 'Total Cost',
                'type'            => 'price',
                'entity_type'     => 'drivers',
                'lookup_type'     => 'leads',
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => NULL,
                'quick_add'       => '1',
                'is_user_defined' => '1',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'source_of_lead',
                'name'            => 'Source of Lead',
                'type'            => 'price',
                'entity_type'     => 'drivers',
                'lookup_type'     => 'leads',
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => NULL,
                'quick_add'       => '1',
                'is_user_defined' => '1',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'cost',
                'name'            => 'Cost',
                'type'            => 'price',
                'entity_type'     => 'drivers',
                'lookup_type'     => 'leads',
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
    }
}
