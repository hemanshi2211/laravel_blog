<x-layout>
    <link rel="stylesheet" href="/app.css">
    <x-nav />
    <x-sidebar />
    <div class="content-wrapper mt-3">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h1>All Posts
                                    @can('write post')
                                    <a name="" id="" class="btn btn-primary float-right" href="{{route('posts.create')}}" role="button">Add</a>
                                    @endcan
                                </h1>
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td> {{ $post->id }} </td>
                                                <td> <img src="/storage/{{ $post->image }}" height="60" width="60"> </td>
                                                <td> {{ ucwords($post->title) }} </td>
                                                <td> {{ ucwords($post->category->name) }} </td>
                                                <td>
                                                    <p><input type="checkbox" id="switch-{{ $post->id }}" switch="bool"
                                                            onchange="change('switch-{{ $post->id }}')"
                                                            {{ $post->status == 0 ? 'checked' : '' }} />
                                                        <label for="switch-{{ $post->id }}" data-on-label="Active" data-off-label="Inactive"></label>
                                                    </p>
                                                </td>
                                                <td>
                                                    <a href="posts/{{ $post->id }}/edit" class="btn"
                                                        role="button"> <i class='fas fa-edit'
                                                            style='font-size:24px; color:green'></i>
                                                    </a>
                                                    @role('admin')
                                                    <button class="btn postdelete_btn" value="{{ $post->id }}"> <i
                                                            class='far fa-trash-alt'
                                                            style='font-size:24px; color:red'></i>
                                                    </button>
                                                    @endrole
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layout>
<script>
    function change(id) {
        var state = $('#' + id).is(':checked');
        var status = state == true ? 0 : 1;
        var s_id = id.split('-')[1];
        console.log(s_id);
        $.ajax({
            type: "get",
            url: "status/" + s_id,
            data: {
                'status': status,
            },
            success: function(response) {
                console.log(response);
                toastr.success(response.title, response.message);
            }
        });
    }
    $(document).ready(function() {
        $(document).on('click', '.postdelete_btn', function() {
            var id = $(this).val();
            // console.log(id);
            swal.fire({
                title: "Delete?",
                icon: 'question',
                text: "Please ensure and then confirm!",
                type: "warning",
                showCancelButton: !0,
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'delete',
                        url: "/posts/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results.success === true) {
                                swal.fire("Done!", results.message, "success");
                                // refresh page after 2 seconds
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            } else {
                                swal.fire("Error!", results.message, "error");
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            });

        });
    });
</script>
@if (session()->has('success'))
<script>
    toastr.success('Done', "{{ session()->get('success') }}");
</script>
@endif
