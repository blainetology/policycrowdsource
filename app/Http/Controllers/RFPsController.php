<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rfp;
use App\Policy;
use App\Section;
use App\Rating;
use App\Collaborator;

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
        if(\Auth::guest())
            return redirect()->guest('login');

        $data = [
            'pagetitle' => 'Draft a RFP'
        ];
        return view('rfps.create',$data);
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
        $input = $request->get('rfp');
        $rfp = Rfp::create($input);
        $rfp_id=$rfp->id;
        Collaborator::create(['rfp_id'=>$rfp_id,'user_id'=>\Auth::user()->id,'accepted'=>1,'owner'=>1,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        return redirect()->route('accountmyrfps');
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
        if(\Auth::guest())
            \Session::put('url.intended', url()->current());  

        $rfp = Rfp::find($id);
        $rfp->rating = round($rfp->rating);
        if($rfp->rating == -0)
            $rfp->rating = 0;
        $ratings = null;
        if(\Auth::check()){
            $ratingsresults = Rating::byUser()->where('rfp_id',$rfp->id)->get();
            if($ratingsresults->count()>0){
                $ratings=[];
                foreach($ratingsresults as $rating)
                    $ratings[$rating->rfp_id]=['rating'=>$rating->rating,'calculated_rating'=>$rating->calculated_rating];
            }
        }
        $data = [
            'rfp'           => $rfp,
            'ratings'       => $ratings,
            'pagetitle'     => $rfp->name
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
