<div class="well search-sidebar">
    <div class="input-group">
        <input type="text" class="form-control input-primary input-sm" name="search[query]" placeholder="search term" aria-label="search term" /><br/>
        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" type="submit">Go!</button>
        </span>
    </div>
    <br/>
    <strong>Document Types</strong><br/>
    <div class="sidebar-category">
        <input type="checkbox" value="1" name="search[policies]" checked /> policy
    </div>
    <div class="sidebar-category">
        <input type="checkbox" value="1" name="search[rfps]" checked /> rfp
    </div>
    <div class="sidebar-category">
        <input type="checkbox" value="1" name="search[questionnaires]" checked /> questionnaire
    </div>
    <br/>

    <strong>Categories</strong><br/>
    @foreach(\App\Category::hasCount()->orderBy('name','asc')->get() as $cat)
        <div class="sidebar-category">
            <input type="checkbox" value="{{$cat->id}}" name="search[categories][]" /> {{$cat->name}}
        </div>
    @endforeach
</div>
