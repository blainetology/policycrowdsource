<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Document;
use App\Section;
use App\Collaborator;
use App\User;

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

        $prefixes = ["Policy","Education","Tax","Healthcare","HOA","Bylaws","Procedures","Human Resources"];

        $content = [
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tincidunt ipsum ut lorem accumsan vulputate. In sit amet arcu imperdiet, ultricies sem nec, venenatis felis. Pellentesque tristique turpis ante, eget scelerisque velit blandit ac. Maecenas sit amet varius augue, in porttitor arcu. Donec gravida nec lacus vitae porttitor. Nulla est velit, scelerisque ac nisl sed, sollicitudin feugiat ligula. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris et lorem elit. Phasellus vestibulum sagittis est, ut bibendum nisl rhoncus nec. Nulla a accumsan nunc.",
            "Morbi a accumsan enim. Mauris vel aliquet ex. Vestibulum gravida nunc a lacus consectetur, sit amet imperdiet arcu pulvinar. In nibh libero, ornare vitae mauris sit amet, lobortis maximus nulla. Pellentesque egestas eros non ornare mollis. Fusce ullamcorper tellus nisl, non pellentesque sem facilisis a. Curabitur condimentum, sapien vel tempor pharetra, erat enim bibendum ligula, ac tempus turpis orci ac magna. Duis fermentum tortor turpis, a vestibulum dolor finibus eget. Fusce libero ex, vestibulum placerat aliquam quis, tristique malesuada mauris. Maecenas dapibus justo vel sodales pulvinar. Aenean sit amet aliquet metus. Donec pulvinar sollicitudin orci, vitae dignissim sapien blandit vel.",
            "Nullam eget nulla magna. Duis vel leo non lectus interdum ultrices ac et est. Ut tincidunt faucibus porta. In in semper orci, sit amet mattis quam. Pellentesque pellentesque massa lorem, sed blandit arcu rutrum at. Pellentesque mattis, odio in mollis imperdiet, neque mauris iaculis nibh, sit amet faucibus turpis erat vel ipsum. Curabitur eu egestas est. Nam tincidunt diam nec erat placerat tempus. Donec porttitor felis ac scelerisque auctor. Proin posuere volutpat lacus non vestibulum. Fusce ut egestas magna.",
            "Etiam ut dui mattis, dictum neque at, ullamcorper urna. Duis semper metus a pulvinar finibus. Duis nec ligula sit amet nisl convallis efficitur in et augue. Sed lobortis sem a ligula facilisis condimentum. Praesent laoreet eleifend erat, sed pellentesque massa mattis nec. Vivamus varius varius nibh in vestibulum. Nunc eget facilisis eros, eu consectetur massa. Proin porta lectus id ligula pellentesque, in accumsan nisi lobortis. Suspendisse porta neque enim, non semper nibh faucibus eget. Donec maximus ut erat in aliquet. Vivamus nec libero arcu. Fusce congue nulla vitae metus tempus, nec aliquam nisi maximus. Mauris gravida a mauris vitae egestas. Nulla facilisi.",
            "Etiam eget diam in neque auctor mattis. Vestibulum pretium tempor mi, at commodo justo laoreet id. Mauris scelerisque diam nunc, eu viverra urna suscipit ullamcorper. Maecenas sollicitudin vulputate leo a eleifend. Maecenas ornare leo sed sem ornare tincidunt. Curabitur vitae ex in justo venenatis venenatis et sed nisi. Proin vitae erat congue, tristique leo quis, tristique enim. Cras imperdiet elit sed pulvinar posuere. Donec vel laoreet ex, vel varius lacus. Quisque sollicitudin, nibh ut placerat feugiat, mauris mauris feugiat ipsum, id luctus eros risus at erat. Morbi in ex feugiat, pulvinar urna ac, aliquet nunc. Nullam rutrum sem vel dui dictum, non placerat neque eleifend. Donec pellentesque interdum mi ut iaculis.",
            "Sed aliquam tortor porta nisl vulputate tincidunt. Mauris sit amet maximus arcu. Sed at suscipit elit, vel bibendum ligula. In a cursus diam. In imperdiet convallis tortor vel viverra. Curabitur sodales sit amet neque eu vestibulum. Pellentesque non accumsan massa, sed blandit tellus. Aliquam erat volutpat. Duis accumsan justo risus, et dignissim augue pellentesque non.",
            "Fusce in tempor nunc. Donec efficitur nisi sit amet tellus eleifend ornare. Sed nisi enim, laoreet ac dictum ut, posuere nec eros. Aenean at urna et sapien viverra vulputate. Praesent pharetra, elit et sodales ornare, massa dui facilisis nisl, ut vestibulum tellus arcu vel est. Praesent nunc sapien, commodo et eros ullamcorper, scelerisque suscipit arcu. Vestibulum semper semper nulla in rhoncus. Proin feugiat gravida erat, euismod molestie velit. Integer porttitor leo mi, sed pharetra leo auctor ac. In pellentesque euismod finibus. Sed malesuada risus ut leo condimentum semper.",
            "Suspendisse neque tellus, dignissim sit amet sagittis in, pulvinar a felis. Proin sit amet tempus leo. Sed rhoncus sem id mi molestie efficitur. Suspendisse egestas sapien non sem eleifend malesuada. In rutrum euismod quam, in feugiat metus pellentesque sed. Donec nec maximus sem, at molestie ante. Phasellus congue ante ac libero pulvinar blandit.",
            "Ut sit amet nibh vitae sem molestie scelerisque eu id elit. Nam pulvinar nisl quam, sed imperdiet urna ornare id. Ut massa ex, commodo at ante non, rutrum porttitor leo. Phasellus at risus id ex laoreet mollis ac non odio. Nulla aliquet blandit tempus. Quisque quis condimentum augue, vel venenatis libero. Nunc consequat rutrum congue. Phasellus sem dui, laoreet ut quam vehicula, porttitor semper purus. Donec laoreet tincidunt neque, non pellentesque velit ultricies ut. Etiam porttitor efficitur eleifend. Etiam dui diam, condimentum in quam nec, scelerisque molestie sapien. Proin maximus scelerisque eros, ac scelerisque leo. Vivamus ac neque ut dolor cursus lacinia eu at magna. Nunc imperdiet venenatis ornare. Nulla auctor ex non suscipit pulvinar.",
            "Nam ullamcorper odio eu massa iaculis dictum. Integer iaculis lectus quis lectus malesuada rutrum. Ut volutpat, ligula vitae consectetur consequat, massa lacus faucibus felis, vel venenatis tortor dolor et metus. Donec vitae pharetra felis, id interdum mi. Nam est ante, ornare ut volutpat vitae, eleifend a massa. Aenean ac blandit enim, eget accumsan nulla. Duis ac laoreet velit. Cras facilisis hendrerit augue. Praesent tristique pellentesque erat, ac placerat justo ornare vel. Vivamus sodales eleifend risus quis semper. Donec suscipit ullamcorper hendrerit.",
            "Sed consectetur, felis at convallis dapibus, orci dui sollicitudin orci, in rutrum nibh nisl et turpis. Duis scelerisque elit quis lorem feugiat, vitae consectetur ex porta. Integer vehicula, lorem facilisis varius dictum, libero lorem imperdiet enim, vel ultrices turpis nunc ac ante. Nunc pellentesque tristique pellentesque. Nulla rhoncus, libero nec blandit tincidunt, magna felis cursus elit, nec volutpat lacus quam nec sapien. Maecenas vitae laoreet risus. Maecenas fermentum in turpis eget eleifend. Morbi ac blandit sem. Phasellus molestie mi at urna tincidunt sagittis. Curabitur id lectus est. Suspendisse vestibulum lacus vitae aliquam aliquet.",
            "Morbi non laoreet ex, id mollis orci. Cras hendrerit nec elit sed fringilla. Aenean tincidunt porta quam, eget pretium orci ultricies at. Mauris ut venenatis leo. Ut vulputate purus in nulla sollicitudin, nec posuere nisl semper. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis vehicula orci ac dolor euismod, vitae efficitur sem pellentesque. Aenean laoreet, lectus ultricies tincidunt feugiat, elit enim dictum augue, eget semper diam enim non diam. Etiam lacinia facilisis dapibus. Mauris gravida nulla sit amet felis placerat, nec lacinia metus posuere. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam interdum consectetur tellus, nec aliquam nibh hendrerit a. Aliquam erat volutpat. Integer arcu nisi, commodo in lectus a, venenatis tristique ipsum. Quisque molestie porta cursus. Nulla congue porta dui in mattis.",
            "Sed interdum vestibulum eleifend. Fusce porttitor tincidunt augue, at convallis neque rhoncus mollis. Vivamus pretium porta arcu ac blandit. Duis sit amet gravida ipsum, eu faucibus tortor. Curabitur tincidunt, nunc eget accumsan interdum, odio massa eleifend nisl, vel bibendum lorem lacus tincidunt dolor. Cras interdum quam in ullamcorper molestie. Fusce id gravida ligula, at volutpat libero.",
            "Nullam non diam ultrices, maximus sapien id, aliquam tortor. Praesent ornare facilisis mi, et pretium tellus eleifend et. Mauris gravida feugiat velit, nec congue mauris ornare a. Vestibulum tincidunt hendrerit erat in venenatis. Nunc dapibus fringilla tempor. Sed semper malesuada tincidunt. Sed accumsan est sit amet ex dignissim auctor. Maecenas sit amet tortor dolor. Maecenas sollicitudin imperdiet erat, ut hendrerit nisl consequat id.",
            "Curabitur eu turpis consequat, eleifend mi nec, pellentesque leo. Praesent sollicitudin ac leo a mattis. Phasellus velit dolor, pulvinar semper commodo id, commodo vitae mi. Fusce at magna odio. Curabitur posuere nisl ac porttitor laoreet. Vestibulum non scelerisque augue, sit amet molestie urna. Cras maximus mollis mattis. Vivamus interdum posuere est vitae congue. Nulla lobortis orci et mi pulvinar, nec ullamcorper quam aliquet. Suspendisse facilisis elit leo, et mattis risus tempor in. Quisque id purus eu magna fringilla ullamcorper. Aliquam vel massa nec purus malesuada lobortis. Quisque volutpat, nisi vitae sagittis ullamcorper, lectus eros commodo nisi, vel condimentum ex ante eu tellus. Nulla at accumsan leo, quis porta lorem. Suspendisse ut pharetra sapien. Nulla ut fringilla nibh."
        ];

        DB::update("ALTER TABLE sections AUTO_INCREMENT = 403000;");

        // Policies

        $document = Document::create(['type'=>'policy','name'=>'Heathcare Reform', 'short_synopsis'=>'Repeal and replacement of the Affordable Care Act','full_synopsis'=>'A formal replacement for the Affordable Care Act. The first step will be to completely repeal the Act. Then the replacement will be established.', 'published'=>1, 'public'=>1, 'house_document'=>0, 'document_id'=>30001, 'published'=>\DB::raw("SUBDATE(NOW(),".rand(5,10).")")]);
        $this->createSections($document,$content);

        $document = Document::create(['type'=>'policy','name'=>'Gun Control Overhaul', 'short_synopsis'=>'Establishing limits on certain kind of firearms and establishing a national background check system','full_synopsis'=>'Establishing limits on certain kind of firearms, specifically assault rifles, and banning the sale of accessories that can be used to adapt semi-automatic to act as an automatic. This also establishes a national background check system to provide for approvals within minutes, thereby eliminating the gun show loophole.', 'published'=>1, 'public'=>1, 'house_document'=>0, 'document_id'=>30002, 'published'=>\DB::raw("SUBDATE(NOW(),".rand(5,10).")")]);
        $this->createSections($document,$content);

        $document = Document::create(['type'=>'policy','name'=>'Local Townhomes CC&amp;R', 'short_synopsis'=>'Establishing new Covenants, Conditions, and Restrictions','full_synopsis'=>'Establishing new Covenants, Conditions, and Restrictions for the local Townhomes Homeowners Association. The current ones are too limiting.', 'published'=>1, 'public'=>1, 'house_document'=>0, 'document_id'=>30002, 'published'=>\DB::raw("SUBDATE(NOW(),".rand(5,10).")")]);
        $this->createSections($document,$content);

        $document = Document::create(['type'=>'policy','name'=>'School Board Policies', 'short_synopsis'=>'Establishing new policies for school board meetings.','full_synopsis'=>'Establishing new policies for school board meetings, for both audience participation and from the board members.', 'published'=>1, 'public'=>1, 'house_document'=>0, 'document_id'=>30003, 'published'=>\DB::raw("SUBDATE(NOW(),".rand(5,10).")")]);
        $this->createSections($document,$content);

        $document = Document::create(['type'=>'policy','name'=>'PTA Bylaws', 'short_synopsis'=>'Establishing new policies and procedures for the local school PTA','full_synopsis'=>'Establishing new policies and procedures for the local elementary school\'s Parent Teacher Association, including member expectations and procedures for working with the administration.', 'published'=>1, 'public'=>1, 'house_document'=>0, 'published'=>\DB::raw("SUBDATE(NOW(),".rand(5,10).")")]);
        $this->createSections($document,$content);

        $document = Document::create(['type'=>'policy','name'=>'Citywide Curfew', 'short_synopsis'=>'Establishing curfews for minors at different age groups','full_synopsis'=>'Establishing curfews for unaccompanied minors. Different age groups will have different curfew times.', 'published'=>1, 'public'=>1, 'house_document'=>0, 'published'=>\DB::raw("SUBDATE(NOW(),".rand(5,10).")")]);
        $this->createSections($document,$content);

        $document = Document::create(['type'=>'policy','name'=>'Zoning Laws', 'short_synopsis'=>'Establishing zoning laws for future development in the city','full_synopsis'=>'Updating the zoning laws in the city for all future development. This includes establishing commercial, manufacturing, public-use, and housing sections.', 'published'=>1, 'public'=>1, 'house_document'=>0, 'published'=>\DB::raw("SUBDATE(NOW(),".rand(5,10).")")]);
        $this->createSections($document,$content);

        DB::update("ALTER TABLE documents AUTO_INCREMENT = 30001;");

        // RFPs
        for($x=0;$x<8;$x++){
            $document = Document::create(['type'=>'rfp', 'name'=>$prefixes[$x].' RFP','short_synopsis'=>'short overview of '.$prefixes[$x].' RFP'.' with quick details about the objective','full_synopsis'=>"A much longer explanation of the ".$prefixes[$x]." RFP and what is expected in a response, including specific items that need to be addressed.",'public'=>1,'published'=>1, 'published'=>\DB::raw("SUBDATE(NOW(),".rand(5,10).")"), 'submission_cutoff'=>\DB::raw("ADDDATE(NOW(),".rand(10,30).")")]);
            $this->createSections($document,$content);
            $document->child_count=$document->children->count();
            $document->save();
        }

        // Questions

        $document = Document::create(['type'=>'question','name'=>'Gun Control Questionaire', 'short_synopsis'=>'Establishing the baseline for views on gun control','full_synopsis'=>'Establishing the baseline for views on gun control', 'published'=>1, 'public'=>1, 'house_document'=>1, 'published'=>\DB::raw("SUBDATE(NOW(),".rand(5,10).")")]);
        $questions = [
            "Should guns be completely unregulated?",
            "Should citizens be allowed to open-carry firearms?",
            "Should citizens be allowed to conceal-carry firearms without a permit?",
            "Should citizens be allowed to conceal-carry firearms WITH a permit?",
            "Should assault rifles be banned?",
        ];
        foreach($questions as $index=>$question)
            $section = Section::create(['title'=>'Question '.($index+1), 'content'=>$question, 'document_id'=>$document->id, 'user_id'=>100000, 'display_order'=>($index+1)]);

        $document = Document::create(['type'=>'question','name'=>'Abortion Questionaire', 'short_synopsis'=>'Establishing the baseline for views on abortion','full_synopsis'=>'Establishing the baseline for views on abortion', 'published'=>1, 'public'=>1, 'house_document'=>1, 'published'=>\DB::raw("SUBDATE(NOW(),".rand(5,10).")")]);
        $questions = [
            "Should access to abortions be unregulated?",
            "Should abortions be legal in cases where the mother's life is endangered by the pregnancy?",
            "If a woman is raped, should she be allowed to get an abortion?",
            "If a woman gets impregnated by her husband, should she be allowed to get an abortion?",
            "If a woman gets impregnated by her boyfriend, should she be allowed to get an abortion?",
            "If a teenaged girl is raped, should she be allowed to get an abortion?",
            "If a teenaged girl gets impregnated by her boyfriend, should she be allowed to get an abortion?",
            "Should abortions be allowed after 1 month?",
            "Should abortions be allowed after 2 month?",
            "Should abortions be allowed after 3 month?",
            "Should abortions be allowed after 4 month?",
            "Should abortions be allowed after 5 month?",
            "Should abortions be allowed after 6 month?",
        ];
        foreach($questions as $index=>$question)
            $section = Section::create(['title'=>'Question '.($index+1), 'content'=>$question, 'document_id'=>$document->id, 'user_id'=>100000, 'display_order'=>($index+1)]);

        $document = Document::create(['type'=>'question','name'=>'Healthcare Questionaire', 'short_synopsis'=>'Establishing the baseline for views on healthcare','full_synopsis'=>'Establishing the baseline for views on healthcare', 'published'=>1, 'public'=>1, 'house_document'=>1, 'published'=>\DB::raw("SUBDATE(NOW(),".rand(5,10).")")]);
        $questions = [
            "Should the government be in charge of healthcare?",
            "Do you consider any government-run healthcare program to be socialized healthcare?",
            "Do you consider the Medicare program to be socialized healthcare?",
            "Should the insurance industty be regualted?",
            "Should pre-exising conditions be required to be covered by law?",
            "Should all children's medical care be covered by a state-sponsored program?"
        ];
        foreach($questions as $index=>$question)
            $section = Section::create(['title'=>'Question '.($index+1), 'content'=>$question, 'document_id'=>$document->id, 'user_id'=>100000, 'display_order'=>($index+1)]);

        // update the sections counts
        foreach(Document::all() as $document){
            $document->section_count = $document->sections->count();
            $document->top_section_count = $document->topLevelSections->count();
            $document->save();
        }
        foreach(Section::all() as $section){
            $section->section_count = Section::where('parent_section_id',$section->id)->count();
            $section->save();
        }

        DB::update("UPDATE sections SET published=NOW()");


    }



    protected function createSections($document,$content){
        for($x=1;$x<=rand(1,6);$x++){
            $section1 = Section::create(['title'=>'Section '.$x, 'content'=>$content[rand(0,14)], 'document_id'=>$document->id, 'user_id'=>100000, 'display_order'=>$x]); //400000
            $sections2num=rand(0,5);
            if($sections2num>0){
                for($y=1;$y<=rand(1,4);$y++){
                    $section2 = Section::create(['content'=>$content[rand(0,14)], 'document_id'=>$document->id, 'parent_section_id'=>$section1->id, 'user_id'=>100000, 'display_order'=>$y]); //400000
                    $sections3num=rand(0,3);
                    if($sections3num>0){
                        for($z=1;$z<=rand(2,4);$z++){
                            $section3 = Section::create(['content'=>$content[rand(0,14)], 'document_id'=>$document->id, 'parent_section_id'=>$section2->id, 'user_id'=>100000, 'display_order'=>$z]); //400000
                        }
                    }
                }
            }
        }
        $user = User::where('email','test@testgmail.com')->first();
        Collaborator::create(['document_id'=>$document->id,'user_id'=>rand(100001,100004),'accepted'=>1,'owner'=>1,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        Collaborator::create(['document_id'=>$document->id,'user_id'=>rand(100010,100030),'accepted'=>1,'owner'=>0,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        if(rand(1,2)==1)
            Collaborator::create(['document_id'=>$document->id,'user_id'=>rand(100031,100050),'accepted'=>1,'owner'=>0,'admin'=>0,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        if(rand(1,2)==1)
            Collaborator::create(['document_id'=>$document->id,'user_id'=>rand(100051,100070),'accepted'=>1,'owner'=>0,'admin'=>0,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        if(rand(1,2)==1)
            Collaborator::create(['document_id'=>$document->id,'user_id'=>rand(100071,100090),'accepted'=>1,'owner'=>0,'admin'=>0,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        if(rand(1,2)==1 && $user)
            Collaborator::create(['document_id'=>$document->id,'user_id'=>$user->id,'accepted'=>1,'owner'=>0,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);

    }
}
