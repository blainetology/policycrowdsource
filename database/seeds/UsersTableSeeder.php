<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::update("ALTER TABLE email_entities AUTO_INCREMENT = 50000;");
        \DB::update("ALTER TABLE users AUTO_INCREMENT = 100000;");

        \App\User::create(['first_name'=>'Blaine', 'last_name'=>'Jones','email'=>'blainecjones@gmail.com','password'=>\Hash::make('temp123'),'admin'=>1,'moderator'=>1,'political_weight'=>-1,'last_login'=>\DB::raw("ADDDATE(NOW(),1)"),'login_count'=>0]);

        $first_names = ['John','Jane','Bill','Mary','Steve','Angie','Michael','Sarah','Richard','Carly'];
        $last_names = ['Smith','Jones','Miller','Hernandez','Roosevelt','Morgan','Johnson','Goldberg','Rodriguez','Page'];

        for($x=0;$x<10;$x++){
            for($y=0;$y<10;$y++){
                $weight = rand(-4,4);
                $rand = rand(10,50);
                \App\User::create(['first_name'=>$first_names[$x], 'last_name'=>$last_names[$y],'email'=>$first_names[$x].$last_names[$y].$rand.'@fakegmail123.com','password'=>\Hash::make('temp123'),'admin'=>0,'moderator'=>0,'political_weight'=>$weight,'last_login'=>\DB::raw("ADDDATE(NOW(),2)"),'login_count'=>0]);
            }
        }
    }
}
