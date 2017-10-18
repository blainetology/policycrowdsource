<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rfp;
use App\Policy;
use App\Section;
use App\Rating;

class RFPsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rfps = Rfp::viewable()->get();
        $data = [
            'rfps'  => $rfps
        ];
        return view('rfps.index',$data);
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
        $rfp = Rfp::find($id);
        $rfp->rating = round($rfp->rating);
        if($rfp->rating == -0)
            $rfp->rating = 0;
        $rating = null;
        if(\Auth::check())
            $rating = Rating::byUser()->where('rfp_id',$rfp->id)->pluck('rating','rfp_id')->toArray();
        $data = [
            'rfp'        => $rfp,
            'ratings'       => $ratings,
            'pagetitle'     => $rfp->name.' | '
        ];

        return view('rfps.show',$data);
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
