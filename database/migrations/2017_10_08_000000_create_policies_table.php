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
            $table->text('short_synopsis')->nullable();
            $table->longtext('full_synopsis')->nullable();
            $table->integer('forked_id')->index()->nullable();
            $table->integer('numbering_pattern_id')->index()->default(1);
            $table->integer('rfp_id')->index()->nullable();
            $table->integer('public')->index()->default(0);
            $table->integer('published')->index()->default(0);
            $table->decimal('rating',5,2)->default(0);
            $table->integer('rating_count')->default(0);
            $table->timestamps();
        });

        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longtext('content')->nullable();
            $table->integer('policy_id')->index();
            $table->integer('user_id')->index();
            $table->integer('revision_id')->index()->nullable();
            $table->integer('parent_section_id')->index()->nullable();
            $table->integer('display_order')->default(1);
            $table->decimal('rating',5,2)->default(0);
            $table->integer('rating_count')->default(0);
            $table->timestamps();
        });

        Schema::create('collaborators', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('policy_id')->index();
            $table->integer('user_id')->index();
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
            $table->integer('user_id')->index();
            $table->integer('history_id')->index()->default(0);
            $table->string('history_type')->index();
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
