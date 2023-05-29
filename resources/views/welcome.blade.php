{{-- {{dd($posts)}} --}}
<x-customer.layout>
    <x-customer.nav />
    <x-customer.header title="{{ Str::contains(url()->current(),'category') ? $posts[0]->category->name : (Str::contains(url()->current(),'author' )  ? $posts[0]->author->name : 'Posts')}}"/>
    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            @foreach ($posts as $post)
                            <div class="col-lg-6">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="/storage/{{$post->image}}" alt="" height="270px">
                                    </div>
                                    <div class="down-content">
                                        <span> {{$post->category->name}} </span>
                                        <a href="/post/{{$post->id}}/show">
                                            <h4> {{$post->title}} </h4>
                                        </a>
                                        <ul class="post-info">
                                            {{-- {{dd($post->author->id)}} --}}
                                            <li><a href="/author/{{$post->author->id}}"> {{$post->author->name}} </a></li>
                                            <li> {{date('F d,Y', strtotime($post->created_at))}}</li>
                                            <li> {{$post->created_at->diffForHumans()}} </li>
                                        </ul>
                                        <p> {{ $post->excerpt }} </p>
                                        <div class="post-options">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-tags"></i></li>
                                                        <li><a href="/post/{{$post->id}}/show">read more</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
    <!-- sidebar Content -->
                <x-customer.sidebar/>
            </div>
        </div>
    </section>
    <x-customer.footer />
</x-customer.layout>
