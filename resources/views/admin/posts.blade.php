<x-layout>
    <x-nav />
    <x-sidebar />

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                @if (session()->has('success'))
                    <script>
                        // toastr.success('Done', "{{ session()->get('success') }}");
                        Swal.fire(
                        'Good job!',
                        '{{ session()->get("success") }}!',
                        'success'
                    )
                    </script>
                @endif
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">All Posts</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                               <a name="" id="" class="btn btn-primary" href="post/create" role="button">Add</a>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="text-blue">
                                            <th>No</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Excerpt</th>
                                            {{-- <th>Body</th> --}}
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td> {{ $post->id }} </td>
                                                <td> <img src="/storage/{{$post->image}}" height="60" width="60"> </td>
                                                <td> {{ ucwords($post->title) }} </td>
                                                <td> {{ ucwords($post->category->name) }} </td>
                                                <td style=" text-overflow: ellipsis; width:30%"> <p> {{ $post->excerpt }} </p> </td>
                                                {{-- <td> {{ ucwords($post->body) }} </td> --}}
                                                @if ($post->status == 0)
                                                    <td><span
                                                            class="bg-info bg-lightblue m-auto p-md-1 rounded-pill">Active</span>
                                                    </td>
                                                @else
                                                    <td><span
                                                            class="bg-red bg-lightblue m-auto p-md-1 rounded-pill">Inactive</span>
                                                    </td>
                                                @endif
                                                <td>
                                                    <a href="post/edit/{{ $post->id }}" class="btn" role="button"> <i class='fas fa-edit' style='font-size:24px; color:green'></i>
                                                    </a>
                                                    <button class="btn postdelete_btn" value="{{ $post->id }}"> <i
                                                            class='far fa-trash-alt' style='font-size:24px; color:red'></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>

        </section>
        <!-- /.content -->
    </div>
</x-layout>
<script>
$(document).ready(function () {
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
                        type: 'POST',
                        url: "{{ url('/post/delete') }}/" + id,
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
