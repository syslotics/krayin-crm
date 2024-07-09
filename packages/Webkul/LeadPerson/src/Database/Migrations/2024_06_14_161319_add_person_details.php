<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasColumn('persons', 'first_name')) {
            Schema::table('persons', function (Blueprint $table) {
                $table->string('first_name')->nullable()->after('id');
                $table->string('last_name')->nullable()->after('first_name');
            });
        }

        if (Schema::hasColumn('persons', 'name')) {
            Schema::table('persons', function (Blueprint $table) {
                $table->dropColumn('name');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            
            // Re-add the 'name' column if it was dropped in the 'up' method
            if (! Schema::hasColumn('drivers', 'name')) {
                $table->string('name')->nullable();
            }
        });
    }
};