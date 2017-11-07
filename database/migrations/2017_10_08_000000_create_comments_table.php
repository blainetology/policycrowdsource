<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('document_id')->index()->nullable();
            $table->integer('policy_id')->index()->nullable();
            $table->integer('section_id')->index()->nullable();
            $table->integer('rfp_id')->index()->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('comments');
    }
}
