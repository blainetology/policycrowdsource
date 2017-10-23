<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Rfp;
use App\Collaborator;

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

        DB::update("ALTER TABLE rfps AUTO_INCREMENT = 30001;");

        $prefixes = ["Policy","Education","Tax","Healthcare","HOA","Bylaws","Procedures","Human Resources"];

        for($x=0;$x<8;$x++){
        	$rfp = Rfp::create(['name'=>$prefixes[$x].' RFP','short_overview'=>'short overview of '.$prefixes[$x].' RFP'.' with quick details about the objective','full_details'=>"A much longer explanation of the RFP and what is expected in a response, including specific items that need to be addressed.<br/><br/>Objective 1:<br/>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br/><br/>Objective 2:<br/>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?<br/><br/>Objective 3:<br/>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.",'public'=>1,'published'=>1,'rating'=>rand(-3,3),'rating_count'=>rand(50,70), 'submission_start'=>\DB::raw("SUBDATE(NOW(),".rand(5,10).")"), 'submission_cutoff'=>\DB::raw("ADDDATE(NOW(),".rand(10,30).")")]);
            Collaborator::create(['rfp_id'=>$rfp->id,'user_id'=>(100000+rand(0,1)),'accepted'=>1,'owner'=>1,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
            Collaborator::create(['rfp_id'=>$rfp->id,'user_id'=>(100001+rand(2,4)),'accepted'=>1,'owner'=>0,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
            Collaborator::create(['rfp_id'=>$rfp->id,'user_id'=>(100002+rand(5,7)),'accepted'=>1,'owner'=>0,'admin'=>0,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
            $rfp->submission_count=$rfp->policies->count();
            $rfp->save();
        }
    }
}
