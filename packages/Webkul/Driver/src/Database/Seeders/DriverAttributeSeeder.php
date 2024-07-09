<?php

namespace Webkul\Driver\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Path= php artisan db:seed --class="Webkul\\Driver\\Database\\Seeders\\DriverAttributeSeeder"
 */
class DriverAttributeSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $attributes = [
            [
                'code'            => 'first_name',
                'name'            => 'First Name',
                'type'            => 'text',
                'entity_type'     => 'drivers',
                'lookup_type'     => NULL,
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'last_name',
                'name'            => 'Last Name',
                'type'            => 'text',
                'entity_type'     => 'drivers',
                'lookup_type'     => NULL,
                'validation'      => NULL,
                'sort_order'      => NULL,
                'is_required'     => '1',
                'is_unique'       => '0',
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
                'is_unique'       => '0',
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
                'is_unique'       => '1',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
        ];


        foreach ($attributes as $attribute) {
            DB::table('attributes')->updateOrInsert(['code' => $attribute['code']], $attribute);
        }

        DB::table('attributes')->where([
            'entity_type'     => 'drivers',
            'code'            => 'name',
        ])->delete();
    }
}