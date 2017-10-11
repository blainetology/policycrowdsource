<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PoliciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::update("ALTER TABLE policies AUTO_INCREMENT = 20000;");
        \DB::update("ALTER TABLE sections AUTO_INCREMENT = 400000;");
    }
}
