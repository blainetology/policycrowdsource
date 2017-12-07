<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
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
        $policies = Document::policy()->viewable()->get();
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
        $input['type'] = 'policy';
        $document = Document::create($input);
        $document_id=$document->id;
        Collaborator::create(['document_id'=>$document_id,'user_id'=>\Auth::user()->id,'accepted'=>1,'owner'=>1,'admin'=>1,'editor'=>1,'reviewer'=>1,'viewer'=>1]);
        return redirect()->route('policies.edit',$document_id);
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
        $document = Document::policy()->where('id',$id)->first();
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

        $policy = Document::policy()->where('id',$id)->first();
        if(!$policy)
            return redirect()->route('policies.index');
        if(!$policy->isEditor())
            return redirect()->route('policies.show',$policy->id);

        $data = [
            'pagetitle' => 'Draft a Policy',
            'document'  => $policy,
            'input'     => $policy->toArray(),
            'sections'  => Section::sortSections($policy->sections->toArray()),
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

        $document = Document::find($pid);
        if(!$document)
            return redirect()->route('home');
        $sections = Section::where('policy_id',$document->id)->where('parent_section_id',$sid)->orderBy('display_order','asc')->get();
        $document->rating = round($document->rating);
        if($document->rating == -0)
            $document->rating = 0;
        $ratings = null;
        if(\Auth::check()){
            $ratings=['policy'=>null,'sections'=>null];
            $ratingsresult = Rating::byUser()->where('policy_id',$document->id)->first();
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
            'policy'        => $document,
            'sections'      => $sections,
            'ratings'       => $ratings,
            'pagetitle'     => $document->name
        ];

        return view('policies.section',$data);
    }

    public function addsection(Request $request){
        $document = Document::policy()->where('id',$request->policy_id)->first();
        if($document){
            if($document->isEditor()){
                $count = Section::where('document_id',$document->id)->where('parent_section_id',$request->parent_section_id)->count()+1;
                $section = Section::create(['document_id'=>$document->id,'parent_section_id'=>$request->parent_section_id,'display_order'=>$count,'user_id'=>\Auth::user()->id]);
                return '<div id="sectionContainer'.$section->id.'" class="section-container section-edit rating_'.round($section->political_rating).' row"><div class="col-md-12"><div class="row  document-section" data-section="'.$section->id.'" id="section'.$section->id.'"><div class="col-md-12"><div class="form-group">'.\Form::text('section'.$section->id,$section->title,['name'=>'section['.$section->id.'[title]', 'class'=>'form-control', 'placeholder'=>'section title']).'</div><div class="form-group">'.\Form::textarea('section'.$section->id,$section->content,['name'=>'section['.$section->id.'[content]', 'class'=>'form-control auto-size', 'placeholder'=>'section content']).'</div><input type="hidden" name="section['.$section->id.'][parent_section_id]" value="'.$section->parent_section_id.'"><div class="text-left"><a href="javascript:PCApp.add_'.$document->type.'_section('.$document->id.','.$section->id.')" class="btn btn-xs btn-info">new subsection</a></div></div></div><div id="subSections'.$section->id.'"></div></div></div>';
            }
        }
        return "";
    }
}
