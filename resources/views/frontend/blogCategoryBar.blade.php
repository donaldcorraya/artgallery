<style>

#blogCatSearch{
    position: relative;
}

</style>
<div class="filter-content">
    <div class="card-body">
        <form class="pb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="{{ __('messages.Search') }}" id="blogCatSearch">
                <div class="blog_search_section" style="width: max-content; height: auto; position: absolute; top: 43px;border-radius: 4px; display: block"></div>
                <div class="input-group-append">
                    <button class="btn btn-light" type="button"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        <ul class="navbar-nav ms-auto ">
            @foreach($blogCategoryBar as $cat)
                
                <?php
                    $current_id = (int)request()->segment(count(request()->segments()));
                    $cat_id = (int)$cat['id'];
                    $class = '';

                    if($cat_id == $current_id){
                        $class = 'class=active';
                    }
                ?>
                <li {{ $class }}>
                    <a href="{{ route('front.blog.category', ['id' => $cat['id']]) }}">{{ $cat['name'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

