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
        Schema::create('driver_lead', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('lead_id')->unsigned();
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');

            $table->unsignedInteger('driver_id');

            $table->decimal('cost', 12, 4)->nullable();
            $table->decimal('tax', 12, 4)->nullable();
            $table->decimal('gratuity', 12, 4)->nullable();
            $table->decimal('extra_addons', 12, 4)->nullable();
            $table->decimal('total_cost', 12, 4)->nullable();
            $table->string('source_of_lead')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers_lead');
    }
};

