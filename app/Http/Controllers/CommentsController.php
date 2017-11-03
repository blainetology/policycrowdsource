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
        return "posted";
    }

    public function postrfp(Request $request, $rid){
        return "posted";
    }

}
