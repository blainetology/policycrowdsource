<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\Section;
use App\Rating;
use App\Collaborator;

class BrowseController extends Controller
{

    public function index(){
        //
        $documents = Document::viewable();
        if(\Request::get('type'))
            $documents = $documents->whereIn('type',\Request::get('type',['']));
        if(\Request::get('cat'))
            $documents = $documents->hasCategories();
        $documents = $documents->byPublished()->get();
        $data = [
            'documents'  => $documents,
            'pagetitle' => 'Browse'
        ];
        return view('browse.index',$data);
    }

    public function create(){
        return redirect()->route('browse.index');
    }

    public function store(Request $request){
        return redirect()->route('browse.index');
    }

    public function show($id){
        return redirect()->route('browse.index');
    }

    public function edit($id){
        return redirect()->route('browse.index');
    }

    public function update(Request $request, $id){
        return redirect()->route('browse.index');
    }

    public function destroy($id){
        return redirect()->route('browse.index');
    }

}
