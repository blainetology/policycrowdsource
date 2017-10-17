<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Policy;
use App\Section;
use App\Rating;

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
            'policies'  => $policies
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $policy = Policy::find($id);
        $policy->rating = round($policy->rating);
        if($policy->rating == -0)
            $policy->rating = 0;
        $ratings = null;
        if(\Auth::check())
            $ratings = Rating::byUser()->whereIn('section_id',$policy->sections->pluck('id'))->pluck('rating','section_id')->toArray();
        $data = [
            'policy'        => $policy,
            'sections'      => Policy::sortSections($policy->sections->toArray()),
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
}
