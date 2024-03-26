<aside class="col-md-3 mb-5">
    <div class="card">
        <article class="filter-group Product_categories">
            <header class="card-header">
                <i class="icon-control fa fa-chevron-down"></i>
                <h6 class="title">{{ __('messages.BlogCategories') }}</h6>
            </header>
            <div class="filter-content">
                @include('frontend.blogCategoryBar')
            </div>
        </article>
        <article class="filter-group Product_categories">
            <header class="card-header">
                <i class="icon-control fa fa-chevron-down"></i>
                <h6 class="title">{{ __('messages.RecentPosts') }}</h6>
            </header>
            <div class="filter-content">
                <div class="card-body">
                    @include('frontend.recentPost')
                </div>
            </div>
        </article>

        <!-- <article class="filter-group Product_categories">
            <header class="card-header">
                <i class="icon-control fa fa-chevron-down"></i>
                <h6 class="title">Recent Comments</h6>
            </header>
            <div class="filter-content">
                <div class="card-body">
                    <ul class="navbar-nav ms-auto ">
                        <li><a href="#">Alone With My Thoughts</a></li>
                        <li><a href="#">Five Days for Music</a></li>
                        <li><a href="#">My Style in My Life</a></li>
                        <li><a href="#">Moment For Shooting</a></li>
                        <li><a href="#">A Mini Tour Of My House</a></li>
                    </ul>
                </div>
            </div>
        </article>

        <article class="filter-group Product_categories">
            <header class="card-header">
                <i class="icon-control fa fa-chevron-down"></i>
                <h6 class="title">Archives</h6>
            </header>
            <div class="filter-content">
                <div class="card-body">
                    <ul class="navbar-nav ms-auto ">
                        <li><a href="#">December 2023 </a></li>
                        <li><a href="#">January 2024</a></li>
                    </ul>
                </div>
            </div>
        </article>
        <article class="filter-group Product_categories">
            <header class="card-header">
                <i class="icon-control fa fa-chevron-down"></i>
                <h6 class="title">Meta</h6>
            </header>
            <div class="filter-content">
                <div class="card-body">
                    <ul class="navbar-nav ms-auto ">
                        <li><a href="#">Log in</a></li>
                        <li><a href="#">Entries feed</a></li>
                        <li><a href="#">Comments feed</a></li>
                    </ul>
                </div>
            </div>
        </article> -->
    </div>
</aside>