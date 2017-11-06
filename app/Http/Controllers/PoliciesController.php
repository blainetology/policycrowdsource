<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Policy;
use App\Section;
use App\Rating;
use App\Collaborator;

class PoliciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $policies = Policy::viewable()->get();
        $data = [
            'policies'  => $policies,
            'pagetitle' => 'Browse Policies'
        ];
        return view('policies.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (\Auth::guest())
            return redirect()->guest('login');

        $data = [
            'pagetitle' => 'Draft a Policy'
        ];
        return view('policies.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->get('policy');
        $policy = Policy::create($input);
        $policy_id=$policy->id;
        Collaborator::create(['policy_id'=>$policy_id,'user_id'=>\Auth::user()->id,'accepted'=>1,'owner'=>1,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        return redirect()->route('policies.edit',$policy_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(\Auth::guest())
            \Session::put('url.intended', url()->current());  
        //
        $policy = Policy::find($id);
        $policy->rating = round($policy->rating);
        if($policy->rating == -0)
            $policy->rating = 0;
        $ratings = null;
        if(\Auth::check()){
            $ratings=['document'=>null,'sections'=>null];
            $ratingsresult = Rating::byUser()->where('policy_id',$policy->id)->first();
            if($ratingsresult)
                $ratings['document']=['rating'=>$ratingsresult->rating,'calculated_rating'=>$ratingsresult->calculated_rating];
            $ratingsresults = Rating::byUser()->whereIn('section_id',$policy->sections->pluck('id'))->get();
            if($ratingsresults->count()>0){
                $ratings['sections']=[];
                foreach($ratingsresults as $rating)
                    $ratings['sections'][$rating->section_id]=['rating'=>$rating->rating,'calculated_rating'=>$rating->calculated_rating];
            }
        }
        $data = [
            //'policyescaped' => Policy::where('id',$id)->with('topLevelSectionsNested')->first(),
            'policy'        => $policy,
            'doctype'       => 'policy',
            'sections'      => Section::sortSections($policy->sections->toArray()),
            'ratings'       => $ratings,
            'pagetitle'     => $policy->name
        ];

        return view('policies.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(!\Auth::check())
            return redirect()->route('policies.index');
        $data = [
            'pagetitle' => 'Draft a Policy',
            'policy'    => Policy::find($id)
        ];
        return view('policies.create',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getsubsections($pid,$sid){

        $policy = Policy::find($pid);
        if(!$policy)
            return redirect()->route('home');
        $sections = Section::where('policy_id',$policy->id)->where('parent_section_id',$sid)->orderBy('display_order','asc')->get();
        $policy->rating = round($policy->rating);
        if($policy->rating == -0)
            $policy->rating = 0;
        $ratings = null;
        if(\Auth::check()){
            $ratings=['policy'=>null,'sections'=>null];
            $ratingsresult = Rating::byUser()->where('policy_id',$policy->id)->first();
            if($ratingsresult)
                $ratings['policy']=['rating'=>$ratingsresult->rating,'calculated_rating'=>$ratingsresult->calculated_rating];
            $ratingsresults = Rating::byUser()->whereIn('section_id',$sections->pluck('id'))->get();
            if($ratingsresults->count()>0){
                $ratings['sections']=[];
                foreach($ratingsresults as $rating)
                    $ratings['sections'][$rating->section_id]=['rating'=>$rating->rating,'calculated_rating'=>$rating->calculated_rating];
            }
        }
        $data = [
            'policy'        => $policy,
            'sections'      => $sections,
            'ratings'       => $ratings,
            'pagetitle'     => $policy->name
        ];

        return view('policies.section',$data);
    }
}
