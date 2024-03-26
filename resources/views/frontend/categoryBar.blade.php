<div class="filter-content">
    <div class="card-body">
        <form class="pb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="{{ __('messages.Search') }}" id="shopCat">
                <div class="blog_search_section" style="width: max-content; height: auto; position: absolute; top: 43px;border-radius: 4px; display: block"></div>
                <div class="input-group-append">
                    <button class="btn btn-light" type="button"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        <ul class="navbar-nav ms-auto cat_ul">
            @foreach($categoryBar as $cat)                
                <li><a class="category_item" data-index="{{ $cat['id'] }}" href="javascript:void(0)">{{ $cat['name'] }}</a></li>
            @endforeach
        </ul>
    </div>
</div>

