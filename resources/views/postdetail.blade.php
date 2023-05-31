<x-customer.layout>
    <x-customer.nav />
    <x-customer.header title="Post Detail" />
    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="/storage/{{ $post->image }}" alt="">
                                    </div>
                                    <div class="down-content">
                                        <span> {{ $post->category->name }} </span>
                                        <a href="post-details.html">
                                            <h4> {{ $post->title }} </h4>
                                        </a>
                                        <ul class="post-info">
                                            <li>Admin</li>
                                            <li> {{ date('F d,Y', strtotime($post->created_at)) }}</li>
                                            <li> {{ $post->created_at->diffForHumans() }} </li>
                                        </ul>
                                        <p class="font-weight-bold"> {{ $post->excerpt }} </p>

                                        <div>{!! $post->body !!}</div>

                                        <div class="post-options">
                                            <div class="row">
                                                <div class="col">
                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-tags"></i></li>
                                                        <li><a href="/">Back {{$post->id}} </a></li>
                                           @php
                                               $like = App\Models\Like::where('status',1)->where('posts_id',$post->id)->count();
                                               $dislike = App\Models\Like::where('status',0)->where('posts_id',$post->id)->count();
                                           @endphp
                            <button type="button" id="dislikebtn" value="{{$post->id}}" class="btn btn-danger float-right ml-3"><i class="fa fa-thumbs-down" style="font-size:24px"></i><span id="dislike" style="color: white">{{$dislike}}</span></button>
                            <button type="button" id="likebtn" value="{{$post->id}}" class="btn btn-success float-right "><i class="fa fa-thumbs-up" style="font-size:24px"></i> <span id="like" style="color: white">{{$like}}</span></button>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @auth
                                <div class="col-lg-12">
                                    <div class="sidebar-item submit-comment">
                                        <div class="sidebar-heading">
                                            <h2>Your comment </h2>
                                        </div>
                                        <div class="content">
                                            <form id="comment" action="/comment/{{ $post->id }}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <fieldset>
                                                            <textarea name="body" rows="6" id="body" placeholder="Type your comment" required=""></textarea>
                                                            @error('body')
                                                                <p class="text-red-500 mt-1 text-xm" style="color:red">
                                                                    {{ $message }} </p>
                                                            @enderror
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <fieldset>
                                                            <button type="submit" id="form-submit"
                                                                class="main-button">Submit</button>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <p> for the participate do <a href="/login/create">Login</a> Or <a href="/registration/create">Rrgistration</a> </p>
                            @endauth
                            <div class="col-lg-12">
                                <div class="sidebar-item comments">
                                    <div class="sidebar-heading">
                                        <h2>comments</h2>
                                    </div>
                                    <div class="content">
                                        <ul>
                                            @forelse ($post->comments as $comment)
                                            <li>
                                                <div class="author-thumb">
                                                    <img src="https://i.pravatar.cc/60?u={{auth()->id()}}" alt="">
                                                </div>
                                                <div class="right-content">
                                                    <h4> {{$comment->author->name}} <span> {{$comment->created_at->diffForHumans()}} </span></h4>
                                                    <p> {{ $comment->body }} .</p>
                                                </div>
                                            </li>
                                            <br>
                                            @empty
                                            <p> no Comments Here.... </p>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-customer.sidebar />
            </div>
        </div>
    </section>
    <x-customer.footer />
</x-customer.layout>
<script>
    $(document).ready(function () {
        $(document).on('click','#likebtn', function () {
            var id = $(this).val();
            $.ajax({
                type: "post",
                url: "/like/" + id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    'status' : '1',
                },
                success: function (response) {
                    console.log(response);
                    $('#like').html(response.like);
                    $('#dislike').html(response.dislike);
                }
            });
        });
        $(document).on('click','#dislikebtn', function () {
            var id = $(this).val();
            $.ajax({
                type: "post",
                url: "/like/" + id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    'status' : '0',
                },
                success: function (response) {
                    console.log(response);
                    $('#like').html(response.like);
                    $('#dislike').html(response.dislike);
                }
            });
        });
    });
</script>
