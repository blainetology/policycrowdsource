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
                $rating = Rating::politicalWeightCalculate($ratingstotal,$ratingscount);
                $section->political_rating=$rating;
                $section->ratings_count=Rating::where('section_id',$section->id)->active()->count();
                $section->ratings_count_minus2=Rating::where('section_id',$section->id)->active()->where('rating','-2')->count();
                $section->ratings_count_minus1=Rating::where('section_id',$section->id)->active()->where('rating','-1')->count();
                $section->ratings_count_plus1=Rating::where('section_id',$section->id)->active()->where('rating','1')->count();
                $section->ratings_count_plus2=Rating::where('section_id',$section->id)->active()->where('rating','2')->count();
                $section->ratings_avg=Rating::ratingsAvgCalculate($section);
                $section->recalculate=null;
                $section->save();                
            }
        });
        Document::whereNotNull('recalculate')->orderBy('recalculate','asc')->chunk(25,function($documents){
            foreach($documents as $document){
                $ratingstotal = Rating::where('document_id',$document->id)->active()->sum('weighted_rating');
                $ratingscount = Rating::where('document_id',$document->id)->active()->sum('rating_abs_val');
                $rating = Rating::politicalWeightCalculate($ratingstotal,$ratingscount);
                $document->political_rating=$rating;
                $document->ratings_count=Rating::where('document_id',$document->id)->active()->count();
                $document->ratings_count_minus2=Rating::where('document_id',$document->id)->active()->where('rating','-2')->count();
                $document->ratings_count_minus1=Rating::where('document_id',$document->id)->active()->where('rating','-1')->count();
                $document->ratings_count_plus1=Rating::where('document_id',$document->id)->active()->where('rating','1')->count();
                $document->ratings_count_plus2=Rating::where('document_id',$document->id)->active()->where('rating','2')->count();
                $document->ratings_avg=Rating::ratingsAvgCalculate($document);
                $document->ratings_total=($document->ratings_minus2*-2)+($document->ratings_minus1*-1)+($document->ratings_plus1*1)+($document->ratings_plus2*2);
                $document->recalculate=null;
                $document->save();                
            }
        });
    }
}
