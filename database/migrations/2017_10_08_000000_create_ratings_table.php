<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('policy_id')->index()->nullable();
            $table->integer('section_id')->index()->nullable();
            $table->integer('rfp_id')->index()->nullable();
            $table->integer('political_weight')->default(0);
            $table->integer('rating_count')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('weighted_rating')->nullable();
            $table->integer('calculated_rating_count')->nullable();
            $table->integer('calculated_rating')->nullable();
            $table->integer('calculated_weighted_rating')->nullable();
            $table->integer('flagged')->default(0);
            $table->integer('banned')->default(0);
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
        Schema::dropIfExists('ratings');
    }
}
