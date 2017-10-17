<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->integer('email_entity_id')->index()->nullable();
            $table->string('password');
            $table->biginteger('facebook_id')->nullable();
            $table->biginteger('google_id')->nullable();
            $table->integer('verified')->default(0);
            $table->string('verify_code')->nullable();
            $table->integer('admin')->default(0);
            $table->integer('moderator')->default(0);
            $table->integer('political_weight')->default(0);
            $table->dateTime('last_login')->nullable();
            $table->integer('login_count')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('email_entities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('domain')->unique();
            $table->string('name');
            $table->string('type_id');
            $table->timestamps();
        });

        Schema::create('email_entity_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
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
        Schema::dropIfExists('email_entity_types');
        Schema::dropIfExists('email_entities');
        Schema::dropIfExists('users');
    }
}
