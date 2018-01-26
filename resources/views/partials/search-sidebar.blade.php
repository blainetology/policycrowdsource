<div class="well search-sidebar">
{{Form::open(['route'=>'browse.index','method'=>'GET'])}}
    <div class="input-group">
        <input type="text" class="form-control input-primary input-sm" name="query" value="{{\Request::get('query','')}}" placeholder="search term" aria-label="search term" /><br/>
        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" type="submit">Go!</button>
        </span>
    </div>
    <br/>
    <strong>Document Types</strong><br/>
    <div class="sidebar-category">
        <input type="checkbox" value="policy" name="type[]" {{\Request::get('type') ? (in_array('policy',\Request::get('type',[])) ? 'checked' : '') : 'checked'}} /> policy
    </div>
    <div class="sidebar-category">
        <input type="checkbox" value="rfp" name="type[]" {{\Request::get('type') ? (in_array('rfp',\Request::get('type',[])) ? 'checked' : '') : 'checked'}} /> rfp
    </div>
    <div class="sidebar-category">
        <input type="checkbox" value="question" name="type[]" {{\Request::get('type') ? (in_array('question',\Request::get('type',[])) ? 'checked' : '') : 'checked'}} /> questionnaire
    </div>
    <br/>

    <strong>Categories</strong><br/>
    @foreach(\App\Category::hasCount()->orderBy('name','asc')->get() as $cat)
        <div class="sidebar-category">
            <input type="checkbox" value="{{$cat->id}}" name="cat[]" {{in_array($cat->id,\Request::get('cat',[])) ? 'checked' : ''}} /> {{$cat->name}}
        </div>
    @endforeach
{{Form::close()}}
</div>
