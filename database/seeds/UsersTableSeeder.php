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

        \App\User::create(['first_name'=>'Blaine', 'last_name'=>'Jones','email'=>'blainecjones@gmail.com','password'=>\Hash::make('temp123'),'political_weight'=>-1,'last_login'=>\DB::raw("ADDDATE(NOW(),1)"),'login_count'=>0]);
        \App\User::create(['first_name'=>'Carly', 'last_name'=>'Jones','email'=>'actuallcarlyjones@gmail.com','password'=>\Hash::make('temp123'),'political_weight'=>-1,'last_login'=>\DB::raw("ADDDATE(NOW(),1)"),'login_count'=>0]);
        \App\User::create(['first_name'=>'Austin', 'last_name'=>'Baker','email'=>'austinmbaker@gmail.com','password'=>\Hash::make('temp123'),'political_weight'=>-1,'last_login'=>\DB::raw("ADDDATE(NOW(),1)"),'login_count'=>0]);
        \App\User::create(['first_name'=>'Garett', 'last_name'=>'Bingham','email'=>'jebmotherboard@gmail.com','password'=>\Hash::make('temp123'),'political_weight'=>-1,'last_login'=>\DB::raw("ADDDATE(NOW(),1)"),'login_count'=>0]);

        $first_names = ['John','Jane','Bill','Mary','Steve','Angie','Michael','Sarah','Richard','Charlotte','Bob','Elizabeth','Jacques','Meredith','Jose','Amber','Justin','Nancy','Esteban','Barbara'];
        $prefixes = ["","O'","Mc","","Mac","La","","D'","","Di","Fitz"];
        $last_names = ['Smith','Jones','Miller','Hernandez','Roosevelt','Morgan','Johnson','Goldberg','Rodriguez','Page','Gonzalez','Carter','Clinton','Lincoln','Banner','Stark','Baker','Rodriguez','Stevens','Parker','Stanwick','Mason'];

        for($x=100;$x<400;$x++){
            $firstname=$first_names[rand(0,19)];
            $lastname=$prefixes[rand(0,10)].$last_names[rand(0,21)];
            $weight = rand(-5,5);
            if($weight==0){
                $check = rand(1,2);
                if($check==1)
                    $weight=-1;
                else
                    $weight=1;
            }
            $rand = rand(10,50);
            \App\User::create(['first_name'=>$firstname, 'last_name'=>$lastname,'email'=>$firstname.$lastname.$x.'@fakegmail123.com','password'=>\Hash::make('temp123'),'political_weight'=>$weight,'last_login'=>\DB::raw("ADDDATE(NOW(),2)"),'login_count'=>0]);
        }

        \DB::update("ALTER TABLE users AUTO_INCREMENT = 101000;");
        \App\User::create(['first_name'=>'Test', 'last_name'=>'Testor','email'=>'test@testgmail.com','password'=>\Hash::make('temp123'),'political_weight'=>-1,'last_login'=>\DB::raw("ADDDATE(NOW(),1)"),'login_count'=>0]);

    }
}
