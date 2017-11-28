<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\Section;
use App\Rating;
use App\Collaborator;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questions = Document::question()->viewable()->get();
        $data = [
            'questions'  => $questions,
            'pagetitle' => 'Browse Questions'
        ];
        return view('questions.index',$data);
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

        $sections = null;

        $data = [
            'pagetitle' => 'Draft a Question',
            'sections'  => $sections
        ];
        return view('questions.create',$data);
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
        $input = $request->get('document');
        $input['type'] = 'question';
        $document = Document::create($input);
        $document_id=$document->id;
        Collaborator::create(['document_id'=>$document_id,'user_id'=>\Auth::user()->id,'accepted'=>1,'owner'=>1,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        return redirect()->route('questions.edit',$document_id);
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
        $document = Document::question()->where('id',$id)->first();
        $document->rating = round($document->rating);
        if($document->rating == -0)
            $document->rating = 0;
        $ratings = null;
        if(\Auth::check()){
            $ratings=['document'=>null,'sections'=>null];
            $ratingsresult = Rating::byUser()->where('document_id',$document->id)->first();
            if($ratingsresult)
                $ratings['document']=['rating'=>$ratingsresult->rating,'calculated_rating'=>$ratingsresult->calculated_rating];
            $ratingsresults = Rating::byUser()->whereIn('section_id',$document->sections->pluck('id'))->get();
            if($ratingsresults->count()>0){
                $ratings['sections']=[];
                foreach($ratingsresults as $rating)
                    $ratings['sections'][$rating->section_id]=['rating'=>$rating->rating,'calculated_rating'=>$rating->calculated_rating];
            }
        }
        $data = [
            //'policyescaped' => Policy::where('id',$id)->with('topLevelSectionsNested')->first(),
            'document'      => $document,
            'sections'      => Section::sortSections($document->sections->toArray()),
            'ratings'       => $ratings,
            'pagetitle'     => $document->name
        ];

        return view('questions.show',$data);
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
            return redirect()->route('questions.index');

        $question = Document::question()->where('id',$id)->first();
        if(!$question)
            return redirect()->route('questions.index');
        if(!$question->isEditor())
            return redirect()->route('questions.show',$question->id);

        $data = [
            'pagetitle' => 'Draft a Question',
            'document'  => $question,
            'input'     => $question->toArray(),
            'sections'  => $question->sections->toArray()
        ];
        return view('questions.create',$data);
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

        $document = Document::find($pid);
        if(!$document)
            return redirect()->route('home');
        $sections = Section::where('document_id',$document->id)->where('parent_section_id',$sid)->orderBy('display_order','asc')->get();
        $document->rating = round($document->rating);
        if($document->rating == -0)
            $document->rating = 0;
        $ratings = null;
        if(\Auth::check()){
            $ratings=['document'=>null,'sections'=>null];
            $ratingsresult = Rating::byUser()->where('document_id',$document->id)->first();
            if($ratingsresult)
                $ratings['document']=['rating'=>$ratingsresult->rating,'calculated_rating'=>$ratingsresult->calculated_rating];
            $ratingsresults = Rating::byUser()->whereIn('section_id',$sections->pluck('id'))->get();
            if($ratingsresults->count()>0){
                $ratings['sections']=[];
                foreach($ratingsresults as $rating)
                    $ratings['sections'][$rating->section_id]=['rating'=>$rating->rating,'calculated_rating'=>$rating->calculated_rating];
            }
        }
        $data = [
            'policy'        => $document,
            'sections'      => $sections,
            'ratings'       => $ratings,
            'pagetitle'     => $document->name
        ];

        return view('documents.section',$data);
    }
}
