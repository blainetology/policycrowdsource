<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "house_policies" => Document::policy()->house()->viewable()->take(3)->inRandomOrder()->get(),
            "submitted_policies" => Document::policy()->userSubmitted()->viewable()->take(6)->inRandomOrder()->get(),
            "questions" => Document::question()->house()->viewable()->take(3)->inRandomOrder()->get(),
            "rfps" => Document::rfp()->viewable()->take(6)->inRandomOrder()->get(),
        ];
        if(\Auth::check())
            $data['my_policies'] = Document::policy()->userSubmitted()->userCollaboratingOn()->take(3)->inRandomOrder()->get();
        return view('home',$data);
    }
}
