<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('forked_id')->nullable();
            $table->integer('numbering_pattern_id');
            $table->integer('rfp_id');
            $table->integer('public');
            $table->integer('published')->default(0);
            $table->timestamps();
        });

        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('policy_id');
            $table->integer('user_id');
            $table->integer('revision_id')->nullable();
            $table->integer('parent_section_id')->nullable();
            $table->integer('display_order')->default(1);
            $table->timestamps();
        });

        Schema::create('collaborators', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('policy_id');
            $table->integer('user_id');
            $table->integer('accepted')->default(0);
            $table->integer('owner')->default(0);
            $table->integer('admin')->default(0);
            $table->integer('editor')->default(0);
            $table->integer('reviewer')->default(0);
            $table->integer('viewer')->default(0);
            $table->timestamps();
        });

        Schema::create('histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('history_id')->default(0);
            $table->string('history_type');
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
        Schema::dropIfExists('policies');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('collaborators');
        Schema::dropIfExists('histories');
    }
}
