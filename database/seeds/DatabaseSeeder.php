<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(PoliciesTableSeeder::class);
         $this->call(ConstitutionTableSeeder::class);
         $this->call(MagnaCartaTableSeeder::class);
         $this->call(ArticlesOfConfederationTableSeeder::class);
         $this->call(RatingsTableSeeder::class);
         $this->call(CommentsTableSeeder::class);
    }
}
