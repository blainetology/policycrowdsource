<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\Section;
use App\Rating;
use App\User;

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

    public function updatesettings(Request $request){
        $user = \Auth::user();
        if($request->action=='settings'){
            $emailcheck = User::where('email',$request->email)->where('id','!=',\Auth::user()->id)->count();
            if($emailcheck>0)
                return redirect()->route('accountsettings');
            $user->fill($request->toArray());
            $request->session()->flash('success', 'Settings Updated');
        }
        if($request->action=='password'){
            if(!empty($request->password) && !empty($request->password_confirm) && $request->password==$request->password_confirm){
                $user->password = \Hash::make($request->password);
                $request->session()->flash('success', 'Password Updated');
            }
            else{
                $request->session()->flash('error', 'Invalid Password. Try again.');                
            }
        }
        $user->save();
        return redirect()->route('accountsettings');
    }

    public function mypolicies(){
        $data = [
            'policies' => Document::policy()->userCollaboratingOn()->get(),
            'pagetitle' => "My Policies",
            'headertitle' => "Policies On Which I'm Collaborating"
        ];
        return view('account.policies',$data);
    }

    public function myrfps(){
        $data = [
            'rfps' => Document::rfp()->userCollaboratingOn()->get(),
            'pagetitle' => "My RFPs",
            'headertitle' => "RFPs On Which I'm Collaborating"
        ];
        return view('account.rfps',$data);
    }

    public function ratedpolicies(){
        $data = [
            'policies' => Document::policy()->userRatedBy()->get(),
            'pagetitle' => "Rated Policies",
            'headertitle' => "Policies I've Rated"
        ];
        return view('account.policies',$data);
    }

    public function ratedrfps(){
        $data = [
            'rfps' => Document::rfp()->userRatedBy()->get(),
            'pagetitle' => "Rated RFPs",
            'headertitle' => "RFPs I've Rated"
        ];
        return view('account.rfps',$data);
    }

}
