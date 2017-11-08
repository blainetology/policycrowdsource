<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\Section;
use App\Rating;

class RatingsController extends Controller
{
    public function ratedocument($id,$rating)
    {
        //
        if(\Auth::check()){
            $document = Document::find($id);
            if($document){                
                $rated = Rating::firstOrNew(['user_id'=>\Auth::user()->id,'document_id'=>$document->id]);
                $rated->rating=$rating;
                $rated->rating_abs_val=abs($rating);
                $rated->political_weight=\Auth::user()->political_weight;
                $rated->weighted_rating = $rated->rating*$rated->political_weight;
                $rated->calculated_rating=null;
                $rated->calculated_weighted_rating=null;
                $rated->save();
                if($document->recalculate==null)
                    $document->recalculate=\DB::raw('NOW()');
                $document->save();
            }
        }

    }
    public function ratesection($id,$sid,$rating)
    {
        //
        $response = ['calculated'=>null];
        if(\Auth::check()){
            $document = Document::find($id);
            if($document){
                $section = Section::where('id',$sid)->where('document_id',$document->id)->first();
                if($section){
                    $rated = Rating::firstOrNew(['user_id'=>\Auth::user()->id,'section_id'=>$sid]);
                    $rated->rating=$rating;
                    $rated->rating_abs_val=abs($rating);
                    $rated->political_weight=\Auth::user()->political_weight;
                    $rated->weighted_rating = $rated->rating*$rated->political_weight;
                    $rated->calculated_rating=null;
                    $rated->calculated_weighted_rating=null;
                    $rated->save();
                    if($section->recalculate==null)
                        $section->recalculate=\DB::raw('NOW()');
                    $section->save();
                    // if not part of a parent section, updated calculated value of policy
                    if($section->parent_section_id==0){
                        $document = Document::find($section->document_id);
                        if($document){
                            $rated = Rating::firstOrNew(['user_id'=>\Auth::user()->id,'document_id'=>$section->document_id]);
                            $ratingstotal = Rating::where('user_id',\Auth::user()->id)->whereIn('section_id',Section::where('document_id',$document->id)->where('parent_section_id',0)->pluck('id'))->sum('rating');
                            $ratingscount = Rating::where('user_id',\Auth::user()->id)->whereIn('section_id',Section::where('document_id',$document->id)->where('parent_section_id',0)->pluck('id'))->count();
                            if($ratingscount==0)
                                $rating=0;
                            else
                                $rating = $ratingstotal/$ratingscount;
                            if($rating<-1)
                                $rating=-2;
                            elseif($rating<0)
                                $rating=-1;
                            elseif($rating>1)
                                $rating=2;
                            else
                                $rating=1;
                            if($rated->rating!=$rating || $rated->weighted_rating!=($rated->rating*\Auth::user()->political_weight)){
                                $rated->calculated_rating=$rating;
                                $rated->calculated_weighted_rating=($rating*\Auth::user()->political_weight);
                                $rated->save();
                                $response['calculated']=[$document->id,$rated->calculated_rating,'document'];
                            }
                            else{
                                $rated->calculated_rating=null;
                                $rated->calculated_weighted_rating=null;
                                $rated->save();                                
                                $response['calculated']=[$document->id,null,'document'];
                            }
                        }
                    }
                    // if part of a parent section, updated calculated value of parent section
                    elseif($section->parent_section_id>0){
                        $parentsection = Section::find($section->parent_section_id);
                        if($parentsection){
                            $rated = Rating::firstOrNew(['user_id'=>\Auth::user()->id,'section_id'=>$section->parent_section_id]);

                            $ratingstotal = Rating::where('user_id',\Auth::user()->id)->whereIn('section_id',Section::where('document_id',$document->id)->where('parent_section_id',$section->parent_section_id)->pluck('id'))->sum('rating');
                            $ratingscount = Rating::where('user_id',\Auth::user()->id)->whereIn('section_id',Section::where('document_id',$document->id)->where('parent_section_id',$section->parent_section_id)->pluck('id'))->count();
                            if($ratingscount==0)
                                $rating=0;
                            else
                                $rating = $ratingstotal/$ratingscount;
                            if($rating<-1)
                                $rating=-2;
                            elseif($rating<0)
                                $rating=-1;
                            elseif($rating>1)
                                $rating=2;
                            else
                                $rating=1;
                            if($rated->rating!=$rating || $rated->weighted_rating!=($rated->rating*\Auth::user()->political_weight)){
                                $rated->calculated_rating=$rating;
                                $rated->calculated_weighted_rating=($rating*\Auth::user()->political_weight);
                                $rated->save();
                                $response['calculated']=[$parentsection->id,$rated->calculated_rating,'section'];
                            }
                            else{
                                $rated->calculated_rating=null;
                                $rated->calculated_weighted_rating=null;
                                $rated->save();                                
                                $response['calculated']=[$parentsection->id,null,'section'];
                            }
                        }
                    }
                }
            }
        }
        return response()->json($response);
    }
}
