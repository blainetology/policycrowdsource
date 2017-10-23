<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Policy;
use App\Rfp;

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
            "house_policies" => Policy::where('house_policy',1)->viewable()->take(3)->inRandomOrder()->get(),
            "submitted_policies" => Policy::where('house_policy',0)->viewable()->take(3)->inRandomOrder()->get(),
            "rfps" => Rfp::viewable()->take(6)->inRandomOrder()->get()
        ];
        if(\Auth::check())
            $data['my_policies'] = Policy::userCollaboratingOn()->take(3)->inRandomOrder()->get();
        return view('home',$data);
    }
}
