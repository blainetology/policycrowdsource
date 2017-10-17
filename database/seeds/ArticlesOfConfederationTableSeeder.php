<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ArticlesOfConfederationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::update("ALTER TABLE sections AUTO_INCREMENT = 402000;");

        \App\Policy::create(['name'=>'Articles of Confederation', 'short_synopsis'=>'First constitution of the newly formed United States of America.','full_synopsis'=>'First constitution of the newly formed United States of America. In use for the first twelve years of the U.S.A. being a country.', 'published'=>1, 'public'=>1, 'rating'=>rand(-5,5)]);

        \App\Section::create(['content'=>"To all to whom these Presents shall come, we, the undersigned Delegates of the States affixed to our Names send greeting. Whereas the Delegates of the United States of America in Congress assembled did on the fifteenth day of November in the year of our Lord One Thousand Seven Hundred and Seventy seven, and in the Second Year of the Independence of America agree to certain articles of Confederation and perpetual Union between the States of Newhampshire, Massachusetts-bay, Rhodeisland and Providence Plantations, Connecticut, New York, New Jersey, Pennsylvania, Delaware, Maryland, Virginia, North Carolina, South Carolina, and Georgia in the Words following, viz. “Articles of Confederation and perpetual Union between the States of Newhampshire, Massachusetts-bay, Rhodeisland and Providence Plantations, Connecticut, New York, New Jersey, Pennsylvania, Delaware, Maryland, Virginia, North Carolina, South Carolina, and Georgia.", 'policy_id'=>20002, 'user_id'=>100000, 'display_order'=>1]); // 402000
        \App\Section::create(['title'=>"Article I", 'policy_id'=>20002, 'user_id'=>100000, 'display_order'=>2]); // 402001
        \App\Section::create(['title'=>"Article II", 'policy_id'=>20002, 'user_id'=>100000, 'display_order'=>3]); // 402002
        \App\Section::create(['title'=>"Article III", 'policy_id'=>20002, 'user_id'=>100000, 'display_order'=>4]); // 402003
        \App\Section::create(['title'=>"Article IV", 'policy_id'=>20002, 'user_id'=>100000, 'display_order'=>5]); // 402004
        \App\Section::create(['title'=>"Article V", 'policy_id'=>20002, 'user_id'=>100000, 'display_order'=>6]); // 402005
        \App\Section::create(['title'=>"Article VI", 'policy_id'=>20002, 'user_id'=>100000, 'display_order'=>7]); // 402006
        \App\Section::create(['title'=>"Article VII", 'policy_id'=>20002, 'user_id'=>100000, 'display_order'=>8]); // 402007
        \App\Section::create(['title'=>"Article VIII", 'policy_id'=>20002, 'user_id'=>100000, 'display_order'=>9]); // 402008
        \App\Section::create(['title'=>"Article IX", 'policy_id'=>20002, 'user_id'=>100000, 'display_order'=>10]); // 402009
        \App\Section::create(['title'=>"Article X", 'policy_id'=>20002, 'user_id'=>100000, 'display_order'=>11]); // 402010
        \App\Section::create(['title'=>"Article XI", 'policy_id'=>20002, 'user_id'=>100000, 'display_order'=>12]); // 402011
        \App\Section::create(['title'=>"Article XII", 'policy_id'=>20002, 'user_id'=>100000, 'display_order'=>13]); // 402012
        \App\Section::create(['title'=>"Article XIII", 'policy_id'=>20002, 'user_id'=>100000, 'display_order'=>14]); // 402013


    }
}
