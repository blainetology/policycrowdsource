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

        \App\User::create(['first_name'=>'Blaine', 'last_name'=>'Jones','email'=>'blainecjones@gmail.com','password'=>\Hash::make('temp123'),'admin'=>1,'moderator'=>1,'political_weight'=>0,'last_login'=>\DB::raw("ADDDATE(NOW(),1)"),'login_count'=>0]);

        for($x=1;$x<=50;$x++){
            $weight = rand(-4,4);
            \App\User::create(['first_name'=>'John'.str_pad($x, 2, '0', STR_PAD_LEFT), 'last_name'=>'Smith'.str_pad($x, 2, '0', STR_PAD_LEFT),'email'=>'john'.str_pad($x, 2, '0', STR_PAD_LEFT).'smith'.str_pad($x, 2, '0', STR_PAD_LEFT).'@fakegmail123.com','password'=>\Hash::make('temp123'),'admin'=>0,'moderator'=>0,'political_weight'=>$weight,'last_login'=>\DB::raw("ADDDATE(NOW(),2)"),'login_count'=>0]);
        }
    }
}
