<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RFPTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($x=1;$x<10;$x++)
        	\App\Rfp::create(['name'=>'RFP'.$x,'short_overview'=>'short overview','full_details'=>'A much longer explanation of the RFP and what is expected in a response.','public'=>1,'published'=>1,'rating'=>rand(-3,3),'rating_count'=>rand(50,70)]);
    }
}
