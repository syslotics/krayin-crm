<?php

namespace Webkul\LeadPerson\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Path= php artisan db:seed --class="Webkul\\LeadPerson\\Database\\Seeders\\RemoveAttributeSeeder
 */
class RemoveAttributeSeeder extends Seeder
{
    public function run()
    {
        //Lead Value
        $removeLeadValueAttributeInLead = DB::table('attributes')->where([
                'entity_type' => 'leads',
                'code'        => 'lead_value',
            ])->first();

        if ($removeLeadValueAttributeInLead) {
            DB::table('attributes')->where([
                'entity_type' => 'leads',
                'code'        => 'lead_value',
            ])->delete();
        }

        //Title
        $removeTitleAttributeInLead = DB::table('attributes')->where([
            'entity_type' => 'leads',
            'code'        => 'title',
        ])->first();

        if ($removeTitleAttributeInLead) {
            DB::table('attributes')->where([
                'entity_type' => 'leads',
                'code'        => 'title',
            ])->delete();
        }

        //Sales Owner
        $removeSalesOwnerAttributeInLead = DB::table('attributes')->where([
            'entity_type' => 'leads',
            'code'        => 'user_id',
        ])->first();

        if ($removeSalesOwnerAttributeInLead) {
            DB::table('attributes')->where([
                'entity_type' => 'leads',
                'code'        => 'user_id',
            ])->delete();
        }

        //Expected Close Date
        $removeCloseDateAttributeInLead = DB::table('attributes')->where([
            'entity_type' => 'leads',
            'code'        => 'expected_close_date',
        ])->first();

        if ($removeCloseDateAttributeInLead) {
            DB::table('attributes')->where([
                'entity_type' => 'leads',
                'code'        => 'expected_close_date',
            ])->delete();
        }
    }
}