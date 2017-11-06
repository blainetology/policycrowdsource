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
        if(!empty($pid) && !empty($request->id) && !empty($request->type) && $request->type=='policy' && $request->id==$pid){
            $policy = Policy::find($pid);
            if($policy){
                $comment = Comment::create(['user_id'=>\Auth::user()->id,'policy_id'=>$policy->id,'comment'=>trim($request->comment)]);
                if($comment){
                    $policy->comments_count=Comment::where('policy_id',$policy->id)->count();
                    $policy->save();
                    return view('partials.comment',['comment'=>$comment]);
                }
            }
        }
        return "";
    }

    public function postsection(Request $request, $sid){
        if(!empty($sid) && !empty($request->id) && !empty($request->type) && $request->type=='section' && $request->id==$sid){
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
