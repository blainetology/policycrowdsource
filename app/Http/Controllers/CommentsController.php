<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rfp;
use App\Policy;
use App\Section;
use App\Rating;
use App\Comment;

class CommentsController extends Controller
{

    public function getpolicy($pid){
        return "got";
    }

    public function getsection($sid){
        return "got";
    }

    public function getrfp($rid){
        return "got";
    }


    public function postpolicy(Request $request, $pid){
        return "posted";
    }

    public function postsection(Request $request, $sid){
        if(!empty($sid) && !empty($request->section_id) && $request->section_id==$sid){
            $section = Section::find($sid);
            if($section){
                $comment = Comment::create(['user_id'=>\Auth::user()->id,'section_id'=>$section->id,'comment'=>trim($request->comment)]);
                if($comment){
                    $section->comments_count=Comment::where('section_id',$section->id)->count();
                    $section->save();
                    return view('partials.comment',['comment'=>$comment]);
                }
            }
        }
        return "";
    }

    public function postrfp(Request $request, $rid){
        return "posted";
    }

}
