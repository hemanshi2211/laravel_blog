<x-layout>
    <x-nav />
    <x-sidebar />


    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Categories</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <input name="" id="" data-toggle="modal" data-target="#addcategory"
                                    class="btn btn-primary" type="button" value="Add">
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
            {{-- add category model --}}
            <x-cat-modal modalId="addcategory" title="Add Category" errorId="err-name"
             bName="Save" bType="submit" bClass="add_btn"/>

             <x-cat-modal modalId="editcategorymodel" title="Edit Category" errorId="2err-name"
             bName="Update" bType="button" bClass="update_btn"/>


            {{-- edit category model --}}
            {{-- <div class="modal fade" id="editcategorymodel" tabindex="-1" role="dialog"
                aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="container">
                                    <form action="" method="GET">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" name="name" id="editname" class="form-control"
                                                placeholder="" aria-describedby="helpId">
                                        </div>
                                        <p class="text-red " id="2err-name"></p>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="estatus"
                                                    id="1status" value="0" checked>
                                                Active
                                            </label> <br />
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="estatus"
                                                    id="2status" value="1">
                                                Inactive
                                            </label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary update_btn">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}


        </section>
        <!-- /.content -->
    </div>


</x-layout>


{{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script> --}}

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
                    // $('#addcategory').modal('hide');
                    // $('#alert').text("Category added......");

                    // setTimeout(function() {
                    // $('#alert').fadeOut('slow');
                    //     }, 10000);

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
