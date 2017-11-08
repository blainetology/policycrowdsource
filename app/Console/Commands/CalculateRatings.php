<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Document;
use App\Section;
use App\Rating;

class CalculateRatings extends Command
{

    protected $signature = 'calculate:ratings';

    protected $description = 'Process and calculate new section and policy ratings when someone clicks a rating.';

    public function __construct(){
        parent::__construct();
    }

    public function handle(){
        Section::whereNotNull('recalculate')->orderBy('recalculate','asc')->chunk(25,function($sections){
            foreach($sections as $section){
                $ratingstotal = Rating::where('section_id',$section->id)->active()->sum('weighted_rating');
                $ratingscount = Rating::where('section_id',$section->id)->active()->sum('rating_abs_val');
                if($ratingscount==0)
                    $rating=0;
                else
                    $rating = $ratingstotal/$ratingscount;
                if($rating > 5)
                    $rating = 5;
                elseif($rating < -5)
                    $rating = -5;
                $section->political_rating=$rating;
                $section->ratings_count=Rating::where('section_id',$section->id)->active()->count();
                $section->ratings_minus2=Rating::where('section_id',$section->id)->active()->where('rating','-2')->count();
                $section->ratings_minus1=Rating::where('section_id',$section->id)->active()->where('rating','-1')->count();
                $section->ratings_plus1=Rating::where('section_id',$section->id)->active()->where('rating','1')->count();
                $section->ratings_plus2=Rating::where('section_id',$section->id)->active()->where('rating','2')->count();
                $ratings_avg = (($section->ratings_minus2*-2)+($section->ratings_minus1*-1)+($section->ratings_plus1*1)+($section->ratings_plus2*2))/$section->ratings_count;
                if($ratings_avg<-1)
                    $ratings_avg=-2;
                elseif($ratings_avg<0)
                    $ratings_avg=-1;
                elseif($ratings_avg>1)
                    $ratings_avg=2;
                else
                    $ratings_avg=1;
                $section->ratings_avg=$ratings_avg;
                $section->recalculate=null;
                $section->save();                
            }
        });
        Document::whereNotNull('recalculate')->orderBy('recalculate','asc')->chunk(25,function($documents){
            foreach($documents as $document){
                $ratingstotal = Rating::where('document_id',$document->id)->active()->sum('weighted_rating');
                $ratingscount = Rating::where('document_id',$document->id)->active()->sum('rating_abs_val');
                if($ratingscount==0)
                    $rating=0;
                else
                    $rating = $ratingstotal/$ratingscount;
                if($rating > 5)
                    $rating = 5;
                elseif($rating < -5)
                    $rating = -5;
                $document->political_rating=$rating;
                $document->ratings_count=Rating::where('document_id',$document->id)->active()->count();
                $document->ratings_minus2=Rating::where('document_id',$document->id)->active()->where('rating','-2')->count();
                $document->ratings_minus1=Rating::where('document_id',$document->id)->active()->where('rating','-1')->count();
                $document->ratings_plus1=Rating::where('document_id',$document->id)->active()->where('rating','1')->count();
                $document->ratings_plus2=Rating::where('document_id',$document->id)->active()->where('rating','2')->count();
                $ratings_avg = (($document->ratings_minus2*-2)+($document->ratings_minus1*-1)+($document->ratings_plus1*1)+($document->ratings_plus2*2))/$document->ratings_count;
                if($ratings_avg<-1)
                    $ratings_avg=-2;
                elseif($ratings_avg<0)
                    $ratings_avg=-1;
                elseif($ratings_avg>1)
                    $ratings_avg=2;
                else
                    $ratings_avg=1;
                $document->ratings_avg=$ratings_avg;
                $document->ratings_total=($document->ratings_minus2*-2)+($document->ratings_minus1*-1)+($document->ratings_plus1*1)+($document->ratings_plus2*2);
                $document->recalculate=null;
                $document->save();                
            }
        });
    }
}
