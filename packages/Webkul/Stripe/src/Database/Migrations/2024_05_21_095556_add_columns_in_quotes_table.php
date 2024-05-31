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
        Schema::table('quotes', function (Blueprint $table) {
            $table->integer('is_payment_completed')->after('user_id')->nullable();
            $table->boolean('is_done')->after('user_id')->default(0)->nullable();
            $table->string('invoice_path')->after('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropIfExists('is_payment_completed');
            $table->dropIfExists('is_done');
            $table->dropIfExists('invoice_path');
        });
    }
};
