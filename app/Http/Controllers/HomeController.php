<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Policy;

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
            "house_policies" => Policy::where('house_policy',1)->viewable()->take(3)->get()
        ];
        return view('home',$data);
    }
}
