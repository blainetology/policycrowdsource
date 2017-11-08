<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\Section;
use App\Rating;
use App\Comment;

class CommentsController extends Controller
{

    public function getdocument($id){
        return "got";
    }

    public function getsection($id){
        return "got";
    }

    public function postdocument(Request $request, $id){
        if(!empty($id) && !empty($request->id) && !empty($request->type) && $request->id==$id){
            $document = Document::find($id);
            if($document){
                $comment = Comment::create(['user_id'=>\Auth::user()->id,'document_id'=>$document->id,'comment'=>trim($request->comment)]);
                if($comment){
                    $document->comments_count=Comment::where('document_id',$document->id)->count();
                    $document->save();
                    return view('partials.comment',['comment'=>$comment]);
                }
            }
        }
        return "";
    }

    public function postsection(Request $request, $id){
        if(!empty($id) && !empty($request->id) && !empty($request->type) && $request->type=='section' && $request->id==$id){
            $section = Section::find($id);
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

}
