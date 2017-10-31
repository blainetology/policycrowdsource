<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Policy;
use App\Section;
use App\Rfp;
use App\Comment;
use App\User;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $comments = [
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.",
            "Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.",
            "Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.",
            "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.",
            "Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. ",
            "Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.",
            "Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."
        ];

        foreach($comments as $comment){
            $sections = Section::inRandomOrder()->take(30)->get();
            $policies = Policy::inRandomOrder()->take(2)->get();
            $rfps = Rfp::inRandomOrder()->take(2)->get();
            foreach($sections as $section){
                $user = User::inRandomOrder()->first();
                Comment::create(['section_id'=>$section->id,'user_id'=>$user->id,'comment'=>$comment]);
            }
            foreach($policies as $policy){
                $user = User::inRandomOrder()->first();
                Comment::create(['policy_id'=>$policy->id,'user_id'=>$user->id,'comment'=>$comment]);
            }
            foreach($rfps as $rfp){
                $user = User::inRandomOrder()->first();
                Comment::create(['rfp_id'=>$rfp->id,'user_id'=>$user->id,'comment'=>$comment]);
            }
            sleep(2);
        }

        foreach(Policy::all() as $policy){
            $policy->comments_count = Comment::where('policy_id',$policy->id)->count();
            $policy->save();
        }
        foreach(Section::all() as $section){
            $section->comments_count = Comment::where('section_id',$section->id)->count();
            $section->save();
        }
        foreach(Rfp::all() as $rfp){
            $rfp->comments_count = Comment::where('rfp_id',$rfp->id)->count();
            $rfp->save();
        }

    }
}
