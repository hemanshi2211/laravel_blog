<x-layout>
    <x-nav />
    <x-sidebar />
    <div class="content-wrapper">
        <section class="content mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h1>Categories   <input name="" id="" data-toggle="modal" data-target="#addcategory"
                                    class="btn btn-primary float-right" type="button" value="Add"></h1>
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td> {{ $category->id }} </td>
                                                <td> {{ ucwords($category->name) }} </td>
                                                @if ($category->status == 0)
                                                    <td><span
                                                            class="bg-info bg-lightblue m-auto p-md-1 rounded-pill">Active</span>
                                                    </td>
                                                @else
                                                    <td><span
                                                            class="bg-red bg-lightblue m-auto p-md-1 rounded-pill">Inactive</span>
                                                    </td>
                                                @endif
                                                <td>
                                                    <button class="btn edit_btn" value="{{ $category->id }}"> <i
                                                            class='fas fa-edit' style='font-size:24px; color:green'></i>
                                                    </button>
                                                    <button class="btn delete_btn" value="{{ $category->id }}"> <i
                                                            class='far fa-trash-alt'
                                                            style='font-size:24px; color:red'></i>
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

            <x-cat-modal modalId="addcategory" title="Add Category" errorId="err-name" bName="Save" bType="submit"
                bClass="add_btn" />

            <x-cat-modal modalId="editcategorymodel" title="Edit Category" errorId="2err-name" bName="Update"
                bType="button" bClass="update_btn" />
        </section>
    </div>
</x-layout>

@if (session()->has('success'))
    <script>
        toastr.success('Done', "{{ session()->get('success') }}");
    </script>
@endif

<script>
    $(document).ready(function() {
        $('#form-addcategory').submit(function(e) {
            e.preventDefault();

            // alert('hello');
            var name = $('#name-Save').val();
            var status = $('input[type="radio"]:checked').val();
            // var _tokan = $('input[name=_token]').val();

            console.log(name);
            console.log(status);


            $.ajax({
                type: "POST",
                url: "/store",

                data: {
                    "_token": "{{ csrf_token() }}",
                    'name': name,
                    'status': status,
                    // _tokan: _tokan,
                },
                success: function(response) {
                    console.log(response);
                    window.location.reload();
                },
                error: function(dataResult) {
                    console.log(dataResult);
                    $error = dataResult.responseJSON.errors;
                    if (dataResult.status == 422) {
                        $.each($error, function(key, value) {
                            $('#err-' + key).html(value);
                        });
                    }
                }
            });
        });

        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            //  alert('hello');
            var id = $(this).val();
            // console.log(id);
            $.ajax({
                type: "get",
                url: "category/edit/" + id,
                data: {
                    'id': id,
                },
                success: function(response) {
                    console.log(response);
                    $('#editcategorymodel').modal('show');
                    $('.update_btn').val(response.id);
                    $('#name-Update').val(response.name);
                    $("input[type='radio'][value=" + response.status + "]").prop('checked',
                        true);
                }
            });
        });

        $(document).on('click', '.update_btn', function() {
            // alert('hello');
            var eid = $(this).val();
            var ename = $('#name-Update').val();
            var estatus = $('input[name="status-Update"]:checked').val();

            $.ajax({
                type: "GET",
                url: "category/update/" + eid,
                data: {
                    "_token": "{{ csrf_token() }}",
                    'name': ename,
                    'status': estatus,
                },
                success: function(response) {
                    console.log(response);
                    window.location.reload();
                },
                error: function(dataResult) {
                    console.log(dataResult);
                    $error = dataResult.responseJSON.errors;
                    if (dataResult.status == 422) {
                        $.each($error, function(key,
                            value) {
                            $('#2err-' + key).html(
                                value);
                        });
                    }
                }
            });
        });

        $(document).on('click', '.delete_btn', function() {
            var id = $(this).val();
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
                        url: "{{ url('/category/delete') }}/" + id,
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
