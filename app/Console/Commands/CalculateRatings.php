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
                $sid=$section->id;
                $section->political_rating=Rating::politicalWeightCalculate(Rating::section($sid)->sum('weighted_rating'),Rating::section($sid)->sum('rating_abs_val'));
                $section->political_rating_minus2=Rating::politicalWeightCalculate(Rating::section($sid)->rating(-2)->sum('political_weight'),Rating::section($sid)->rating(-2)->count());
                $section->political_rating_minus1=Rating::politicalWeightCalculate(Rating::section($sid)->rating(-1)->sum('political_weight'),Rating::section($sid)->rating(-1)->count());
                $section->political_rating_plus1=Rating::politicalWeightCalculate(Rating::section($sid)->rating(1)->sum('political_weight'),Rating::section($sid)->rating(1)->count());
                $section->political_rating_plus2=Rating::politicalWeightCalculate(Rating::section($sid)->rating(2)->sum('political_weight'),Rating::section($sid)->rating(2)->count());
                $section->ratings_count=Rating::section($sid)->count();
                $section->ratings_count_minus2=Rating::section($sid)->rating(-2)->count();
                $section->ratings_count_minus1=Rating::section($sid)->rating(-1)->count();
                $section->ratings_count_plus1=Rating::section($sid)->rating(1)->count();
                $section->ratings_count_plus2=Rating::section($sid)->rating(2)->count();
                $section->ratings_avg=Rating::ratingsAvgCalculate($section);
                $section->ratings_total=($section->ratings_count_minus2*-2)+($section->ratings_count_minus1*-1)+($section->ratings_count_plus1*1)+($section->ratings_count_plus2*2);
                $section->save();
            }
        });
        Document::whereNotNull('recalculate')->orderBy('recalculate','asc')->chunk(25,function($documents){
            foreach($documents as $document){
                $did=$document->id;
                $document->political_rating=Rating::politicalWeightCalculate(Rating::document($did)->sum('weighted_rating'),Rating::document($did)->sum('rating_abs_val'));
                $document->political_rating_minus2=Rating::politicalWeightCalculate(Rating::document($did)->rating(-2)->sum('political_weight'),Rating::document($did)->rating(-2)->count());
                $document->political_rating_minus1=Rating::politicalWeightCalculate(Rating::document($did)->rating(-1)->sum('political_weight'),Rating::document($did)->rating(-1)->count());
                $document->political_rating_plus1=Rating::politicalWeightCalculate(Rating::document($did)->rating(1)->sum('political_weight'),Rating::document($did)->rating(1)->count());
                $document->political_rating_plus2=Rating::politicalWeightCalculate(Rating::document($did)->rating(2)->sum('political_weight'),Rating::document($did)->rating(2)->count());
                $document->ratings_count=Rating::where('document_id',$did)->count();
                $document->ratings_count_minus2=Rating::document($did)->rating(-2)->count();
                $document->ratings_count_minus1=Rating::document($did)->rating(-1)->count();
                $document->ratings_count_plus1=Rating::document($did)->rating(1)->count();
                $document->ratings_count_plus2=Rating::document($did)->rating(2)->count();
                $document->ratings_avg=Rating::ratingsAvgCalculate($document);
                $document->ratings_total=($document->ratings_count_minus2*-2)+($document->ratings_count_minus1*-1)+($document->ratings_count_plus1*1)+($document->ratings_count_plus2*2);
                $document->save();
            }
        });
    }
}
