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
            $table->integer('house_policy')->index()->default(0);
            $table->integer('starter_policy')->index()->default(0);
            $table->integer('section_count')->default(0);
            $table->integer('top_section_count')->default(0);
            $table->decimal('political_rating',5,2)->default(0);
            $table->integer('ratings_count')->default(0);
            $table->integer('ratings_minus2')->default(0);
            $table->integer('ratings_minus1')->default(0);
            $table->integer('ratings_plus1')->default(0);
            $table->integer('ratings_plus2')->default(0);
            $table->integer('ratings_avg')->default(0);
            $table->integer('ratings_total')->default(0);
            $table->integer('comments_count')->default(0);
            $table->datetime('recalculate')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longtext('content')->nullable();
            $table->string('staged_title')->nullable();
            $table->longtext('staged_content')->nullable();
            $table->integer('policy_id')->index();
            $table->integer('user_id')->index();
            $table->integer('revision_id')->index()->nullable();
            $table->integer('parent_section_id')->index()->default(0);
            $table->integer('starter_policy')->index()->default(0);
            $table->integer('section_count')->default(0);
            $table->integer('display_order')->default(1);
            $table->decimal('political_rating',5,2)->default(0);
            $table->integer('ratings_count')->default(0);
            $table->integer('ratings_minus2')->default(0);
            $table->integer('ratings_minus1')->default(0);
            $table->integer('ratings_plus1')->default(0);
            $table->integer('ratings_plus2')->default(0);
            $table->integer('ratings_avg')->default(0);
            $table->integer('ratings_total')->default(0);
            $table->integer('comments_count')->default(0);
            $table->datetime('recalculate')->nullable();
            $table->timestamps();
        });

        Schema::create('collaborators', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('policy_id')->nullable()->index();
            $table->integer('rfp_id')->nullable()->index();
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

        Schema::create('rfps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('short_overview')->nullable();
            $table->longtext('full_details')->nullable();
            $table->date('submission_start')->index()->nullable();
            $table->date('submission_cutoff')->index()->nullable();
            $table->integer('no_expiration')->index()->default(0);
            $table->integer('submission_count')->default(0);
            $table->integer('public')->index()->default(1);
            $table->integer('published')->index()->default(0);
            $table->integer('house_rfp')->index()->default(0);
            $table->integer('starter_rfp')->index()->default(0);
            $table->decimal('political_rating',5,2)->default(0);
            $table->integer('ratings_count')->default(0);
            $table->integer('ratings_minus2')->default(0);
            $table->integer('ratings_minus1')->default(0);
            $table->integer('ratings_plus1')->default(0);
            $table->integer('ratings_plus2')->default(0);
            $table->integer('ratings_avg')->default(0);
            $table->integer('ratings_total')->default(0);
            $table->integer('comments_count')->default(0);
            $table->datetime('recalculate')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rfps');
        Schema::dropIfExists('policies');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('collaborators');
        Schema::dropIfExists('histories');
    }
}
