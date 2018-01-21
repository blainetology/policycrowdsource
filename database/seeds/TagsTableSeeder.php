<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Document;
use App\Tag;
use App\Category;

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

        $cats = ["Government","Budget","Nature","School","Traffic","Taxes","Medical","Security"];
        $catsmax = count($cats)-1;

        DB::update("ALTER TABLE tags AUTO_INCREMENT = 5000;");
        DB::update("ALTER TABLE categories AUTO_INCREMENT = 6000;");

        foreach($tags as $tag){
            $tag = Tag::firstOrNew(['name'=>strtolower($tag),'slug'=>str_slug($tag)]);
            $tag->save();
        }
        foreach($cats as $cat){
            $cat = Category::firstOrNew(['name'=>strtolower($cat),'slug'=>str_slug($cat)]);
            $cat->save();
        }

        foreach(Document::all() as $document){
            $thetags = [];
            $thecats = [];

            $num=rand(2,5);
            while(count($thetags) < $num){
                $randtag = $tags[rand(0,$tagsmax)];
                $doctag = Tag::firstOrNew(['name'=>strtolower($randtag),'slug'=>str_slug($randtag)]);
                $doctag->save();
                if(!in_array($doctag->id, $thetags))
                    $thetags[] = $doctag->id;
            }

            $num=rand(1,2);
            while(count($thecats) < $num){
                $randcat = $cats[rand(0,$catsmax)];
                $doccat = Category::firstOrNew(['name'=>strtolower($randcat),'slug'=>str_slug($randcat)]);
                $doccat->save();
                if(!in_array($doccat->id, $thecats))
                    $thecats[] = $doccat->id;
            }

            $document->tags()->sync($thetags);
            $document->categories()->sync($thecats);

        }

        foreach(Tag::all() as $tag){
            $tag->count=\DB::table('document_tags')->where('tag_id',$tag->id)->count();
            $tag->save();
        }
        foreach(Category::all() as $cat){
            $cat->count=\DB::table('document_categories')->where('category_id',$cat->id)->count();
            $cat->save();
        }

    }



}
