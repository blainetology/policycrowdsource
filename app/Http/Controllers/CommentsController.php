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
    public function postpolicy(Request $request, $pid)
    {
        //
        if(\Auth::check()){
            return "posted";
        }

    }

    public function postsection(Request $request, $sid)
    {
        //
        if(\Auth::check()){
            return "posted";
        }

    }

    public function postrfp(Request $request, $rid)
    {
        //
        if(\Auth::check()){
            return "posted";
        }

    }

}
