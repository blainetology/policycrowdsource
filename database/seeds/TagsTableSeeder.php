<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Document;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $tags = ["Ipsum", "Dolor", "Sit amet", "consectetur", "Adipiscing", "tincidunt", "Accumsan", "Vulputate", "imperdiet", "ultricies", "Venenatis", "Pellentesque", "tristique", "Turpis Ante", "Eget Scelerisque", "Velit Blandit", "maecenas", "varius augue", "porttitor", "Donec Gravida", "nec lacus", "vitae porttitor", "Morbi a accumsan", "enim", "Mauris vel", "aliquet ex", "Vestibulum", "gravida", "nunc a lacus", "imperdiet", "arcu pulvinar", "In nibh libero", "ornare vitae", "mauris sit amet", "lobortis maximus", "egestas", "eros non", "ornare mollis"];
        $tagsmax = count($tags)-1;

        DB::update("ALTER TABLE tags AUTO_INCREMENT = 50000;");

        for($x=0; $x<20; $x++){
            $tag = $tags[$x];
            Tag::create(['name'=>strtolower($tag),'slug'=>str_slug($tag)]);
        }

        foreach(Document::all() as $document){
            $alltags= [];
            $thetags = [];
            $thecats = [];

            $num=rand(2,5);
            while(count($thetags) < $num){
                $randtag = $tags[rand(0,$tagsmax)];
                $doctag = Tag::firstOrNew(['name'=>strtolower($randtag),'slug'=>str_slug($randtag)]);
                $doctag->save();
                if(!in_array($doctag->id, $thetags))
                    $thetags[] = $doctag->id;
                if(!in_array($doctag->id, $alltags))
                    $alltags[$doctag->id] = ['type'=>'tag'];
            }

            $num=2;
            while(count($thecats) < $num){
                $randtag = $tags[rand(0,$tagsmax)];
                $doctag = Tag::firstOrNew(['name'=>strtolower($randtag),'slug'=>str_slug($randtag)]);
                $doctag->save();
                if(!in_array($doctag->id, $thecats))
                    $thecats[] = $doctag->id;
                if(!in_array($doctag->id, $alltags))
                    $alltags[$doctag->id] = ['type'=>'cat'];
            }

            $document->tags()->sync($alltags);

        }

        foreach(Tag::all() as $tag){
            $tag->tag_count=\DB::table('document_tags')->where('type','tag')->where('tag_id',$tag->id)->count();
            $tag->category_count=\DB::table('document_tags')->where('type','cat')->where('tag_id',$tag->id)->count();
            $tag->all_count = $tag->tag_count+$tag->category_count;
            $tag->save();
        }

    }



}
