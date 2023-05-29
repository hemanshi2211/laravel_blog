<div class="col-lg-4">
    <div class="sidebar">
        <div class="row">
            <div class="col-lg-12">
                <div class="sidebar-item search">
                    <form id="search_form" name="gs" method="GET" action="#">
                        <input type="text" name="search" class="searchText"
                            placeholder="type to search..." autocomplete="on" value="{{ request('search') }}">
                    </form>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item recent-posts">
                    <div class="sidebar-heading">
                        <h2>Recent Posts</h2>
                    </div>
                    @php
                        $posts = App\Models\Posts::latest('created_at')->get();
                    @endphp

                    <div class="content">
                        <ul>
                            @foreach ($posts as $post)
                            <li><a href="post/{{$post->id}}/show">
                                <h5> {{$post->title}} </h5>
                                <span> {{ $post->created_at->diffForHumans() }} </span>
                            </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item categories">
                    <div class="sidebar-heading">
                        <h2>Categories</h2>
                    </div>
                    @php
                        $categories = App\Models\Category::all();
                    @endphp
                    <div class="content">
                        <ul>
                            @foreach ($categories as $category)
                              <li><a href="/category/{{$category->id}}">- {{ucwords($category->name) }} </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
