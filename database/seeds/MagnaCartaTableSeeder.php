<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MagnaCartaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Policy::create(['name'=>'Magna Carta', 'short_synopsis'=>'Declaration by King John addressing grievances.','full_synopsis'=>'Declaration by King John addressing grievances, and establashing certain rights for all men.', 'published'=>1, 'public'=>1, 'rating'=>rand(-5,5)]);
        \App\Policy::create(['name'=>'Magna Carta2', 'short_synopsis'=>'Declaration by King John addressing grievances.','full_synopsis'=>'Declaration by King John addressing grievances, and establashing certain rights for all men.', 'published'=>1, 'public'=>1, 'rating'=>rand(-5,5)]);
        \App\Policy::create(['name'=>'Magna Carta3', 'short_synopsis'=>'Declaration by King John addressing grievances.','full_synopsis'=>'Declaration by King John addressing grievances, and establashing certain rights for all men.', 'published'=>1, 'public'=>1, 'rating'=>rand(-5,5)]);
        \App\Policy::create(['name'=>'Magna Carta4', 'short_synopsis'=>'Declaration by King John addressing grievances.','full_synopsis'=>'Declaration by King John addressing grievances, and establashing certain rights for all men.', 'published'=>1, 'public'=>1, 'rating'=>rand(-5,5)]);
        \App\Policy::create(['name'=>'Magna Carta5', 'short_synopsis'=>'Declaration by King John addressing grievances.','full_synopsis'=>'Declaration by King John addressing grievances, and establashing certain rights for all men.', 'published'=>1, 'public'=>1, 'rating'=>rand(-5,5)]);
        \App\Policy::create(['name'=>'Magna Carta6', 'short_synopsis'=>'Declaration by King John addressing grievances.','full_synopsis'=>'Declaration by King John addressing grievances, and establashing certain rights for all men.', 'published'=>1, 'public'=>1, 'rating'=>rand(-5,5)]);
        \App\Policy::create(['name'=>'Magna Carta7', 'short_synopsis'=>'Declaration by King John addressing grievances.','full_synopsis'=>'Declaration by King John addressing grievances, and establashing certain rights for all men.', 'published'=>1, 'public'=>1, 'rating'=>rand(-5,5)]);
        \App\Policy::create(['name'=>'Magna Carta8', 'short_synopsis'=>'Declaration by King John addressing grievances.','full_synopsis'=>'Declaration by King John addressing grievances, and establashing certain rights for all men.', 'published'=>1, 'public'=>1, 'rating'=>rand(-5,5)]);
        \App\Policy::create(['name'=>'Magna Carta9', 'short_synopsis'=>'Declaration by King John addressing grievances.','full_synopsis'=>'Declaration by King John addressing grievances, and establashing certain rights for all men.', 'published'=>1, 'public'=>1, 'rating'=>rand(-5,5)]);
        \App\Policy::create(['name'=>'Magna Carta10', 'short_synopsis'=>'Declaration by King John addressing grievances.','full_synopsis'=>'Declaration by King John addressing grievances, and establashing certain rights for all men.', 'published'=>1, 'public'=>1, 'rating'=>rand(-5,5)]);
        \App\Policy::create(['name'=>'Magna Carta11', 'short_synopsis'=>'Declaration by King John addressing grievances.','full_synopsis'=>'Declaration by King John addressing grievances, and establashing certain rights for all men.', 'published'=>1, 'public'=>1, 'rating'=>rand(-5,5)]);
        \App\Policy::create(['name'=>'Magna Carta12', 'short_synopsis'=>'Declaration by King John addressing grievances.','full_synopsis'=>'Declaration by King John addressing grievances, and establashing certain rights for all men.', 'published'=>1, 'public'=>1, 'rating'=>rand(-5,5)]);
    }
}
