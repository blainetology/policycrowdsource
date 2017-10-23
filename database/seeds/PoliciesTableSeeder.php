<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Policy;
use App\Section;
use App\Collaborator;

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

        DB::update("ALTER TABLE sections AUTO_INCREMENT = 403000;");

        Policy::create(['name'=>'Heathcare Reform', 'short_synopsis'=>'Repeal and replacement of the Affordable Care Act','full_synopsis'=>'A formal replacement for the Affordable Care Act. The first step will be to completely repeal the Act. Then the replacement will be established.', 'published'=>1, 'public'=>1, 'house_policy'=>0, 'rfp_id'=>30001]);
        Section::create(['content'=>"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.", 'policy_id'=>20003, 'user_id'=>100000, 'display_order'=>1]); //400000
        Section::create(['content'=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.", 'policy_id'=>20003, 'user_id'=>100000, 'display_order'=>2]); //400000
        Collaborator::create(['policy_id'=>20003,'user_id'=>100001,'accepted'=>1,'owner'=>1,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        Collaborator::create(['policy_id'=>20003,'user_id'=>100003,'accepted'=>1,'owner'=>0,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        Collaborator::create(['policy_id'=>20003,'user_id'=>100010,'accepted'=>1,'owner'=>0,'admin'=>0,'editor'=>1,'reviewer'=>1,'viewer'=>1]);


        Policy::create(['name'=>'Gun Control Overhaul', 'short_synopsis'=>'Establishing limits on certain kind of firearms and establishing a national background check system','full_synopsis'=>'Establishing limits on certain kind of firearms, specifically assault rifles, and banning the sale of accessories that can be used to adapt semi-automatic to act as an automatic. This also establishes a national background check system to provide for approvals within minutes, thereby eliminating the gun show loophole.', 'published'=>1, 'public'=>1, 'house_policy'=>0, 'rfp_id'=>30002]);
        Section::create(['content'=>"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.", 'policy_id'=>20004, 'user_id'=>100000, 'display_order'=>1]); //400000
        Section::create(['content'=>"Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.", 'policy_id'=>20004, 'user_id'=>100000, 'display_order'=>2]); //400000
        Collaborator::create(['policy_id'=>20004,'user_id'=>100011,'accepted'=>1,'owner'=>1,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        Collaborator::create(['policy_id'=>20004,'user_id'=>100013,'accepted'=>1,'owner'=>0,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        Collaborator::create(['policy_id'=>20004,'user_id'=>100015,'accepted'=>1,'owner'=>0,'admin'=>0,'editor'=>1,'reviewer'=>1,'viewer'=>1]);


        Policy::create(['name'=>'Breckenridge Townhomes CC&amp;R', 'short_synopsis'=>'Establishing new Covenants, Conditions, and Restrictions','full_synopsis'=>'Establishing new Covenants, Conditions, and Restrictions for the Breckenridge Townhomes Homeowners Association. The current ones are too limiting.', 'published'=>1, 'public'=>1, 'house_policy'=>0, 'rfp_id'=>30002]);
        Section::create(['content'=>"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.", 'policy_id'=>20005, 'user_id'=>100000, 'display_order'=>1]); //400000
        Section::create(['content'=>"Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.", 'policy_id'=>20005, 'user_id'=>100000, 'display_order'=>2]); //400000
        Collaborator::create(['policy_id'=>20005,'user_id'=>100001,'accepted'=>1,'owner'=>1,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        Collaborator::create(['policy_id'=>20005,'user_id'=>100002,'accepted'=>1,'owner'=>0,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);


        Policy::create(['name'=>'School Board Policies', 'short_synopsis'=>'Establishing new policies for school board meetings.','full_synopsis'=>'Establishing new policies for school board meetings, for both audience participation and from the board members.', 'published'=>1, 'public'=>1, 'house_policy'=>0, 'rfp_id'=>30003]);
        Section::create(['content'=>"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.", 'policy_id'=>20006, 'user_id'=>100000, 'display_order'=>1]); //400000
        Section::create(['content'=>"Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.", 'policy_id'=>20006, 'user_id'=>100000, 'display_order'=>2]); //400000
        Collaborator::create(['policy_id'=>20006,'user_id'=>rand(100001,100003),'accepted'=>1,'owner'=>1,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        Collaborator::create(['policy_id'=>20006,'user_id'=>rand(10010,100020),'accepted'=>1,'owner'=>0,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        Collaborator::create(['policy_id'=>20006,'user_id'=>rand(10021,100030),'accepted'=>1,'owner'=>0,'admin'=>0,'editor'=>1,'reviewer'=>1,'viewer'=>1]);

        Policy::create(['name'=>'PTA Bylaws', 'short_synopsis'=>'Establishing new policies and procedures for the local school PTA','full_synopsis'=>'Establishing new policies and procedures for the local elementary school\'s Parent Teacher Association, including member expectations and procedures for working with the administration.', 'published'=>1, 'public'=>1, 'house_policy'=>0]);
        Section::create(['content'=>"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.", 'policy_id'=>20007, 'user_id'=>100000, 'display_order'=>1]); //400000
        Section::create(['content'=>"Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.", 'policy_id'=>20007, 'user_id'=>100000, 'display_order'=>2]); //400000
        Collaborator::create(['policy_id'=>20007,'user_id'=>rand(100001,100003),'accepted'=>1,'owner'=>1,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        Collaborator::create(['policy_id'=>20007,'user_id'=>rand(10010,100020),'accepted'=>1,'owner'=>0,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        Collaborator::create(['policy_id'=>20007,'user_id'=>rand(10021,100030),'accepted'=>1,'owner'=>0,'admin'=>0,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
    }
}
