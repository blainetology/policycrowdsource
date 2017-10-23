<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rfp;
use App\Policy;
use App\Section;
use App\Rating;

class AccountController extends Controller
{
    public function settings(){
        //
        $user = \Auth::user();
        $data = [
            'user' => $user,
            'pagetitle' => 'Settings'
        ];
        return view('account.settings',$data);
    }

    public function updatesettings(Request $request, $id){
        //
        $user = \Auth::user();
        $user->fill($request->toArray());
        $user->save();

        if(!empty($request->password) && !empty($request->password2) && $request->password==$request->password2){
            $user->password = \Hash::make($request->password);
            $user->save();
        }

        //Log::user($user->id,'settings');
        return redirect('/');
    }

    public function mypolicies(){
        $data = [
            'policies' => Policy::userCollaboratingOn()->get(),
            'pagetitle' => "My Policies",
            'headertitle' => "Policies On Which I'm Collaborating"
        ];
        return view('account.policies',$data);
    }

    public function myrfps(){
        $data = [
            'rfps' => Rfp::userCollaboratingOn()->get(),
            'pagetitle' => "My RFPs",
            'headertitle' => "RFPs On Which I'm Collaborating"
        ];
        return view('account.rfps',$data);
    }

    public function ratedpolicies(){
        $data = [
            'policies' => Policy::userRatedBy()->get(),
            'pagetitle' => "Rated Policies",
            'headertitle' => "Policies I've Rated"
        ];
        return view('account.policies',$data);
    }

    public function ratedrfps(){
        $data = [
            'rfps' => Rfp::userRatedBy()->get(),
            'pagetitle' => "Rated RFPs",
            'headertitle' => "RFPs I've Rated"
        ];
        return view('account.rfps',$data);
    }

}
