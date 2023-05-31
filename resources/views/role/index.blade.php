<x-layout>
<x-nav/>
<x-sidebar/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/toggle.css">
<div class="content-wrapper">
    <section class="content mt-3">
        <div class="container-fluid">
            @if (session()->has('success'))
    <script>
        toastr.success('Done', "{{ session()->get('success') }}");
    </script>
@endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h1>Role & Permission
                                @can('write role')
                                <a href="role/create" class="btn btn-primary float-right" type="button">Add</a>
                                @endcan
                            </h1>
                            <table id="myTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Role Name</th>
                                        <th>Create At</th>
                                        {{-- <th style="text-align: center; width: 30%;"><span>Permission</span> <br/><span class="p-5 ml-2">write</span><span class="p-5 ml-4">edit</span><span class="p-5 ml-4">publish</span></th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                    @if ($role->name == 'admin')
                                    @continue
                                    @endif
                                    <tr>
                                        <td> {{ $role->name }} </td>
                                        <td> {{  date('F d,Y',strtotime($role->created_at)) }} </td>
                                        {{-- <td> {{  $role->created_at->diffForHumans() }} </td> --}}
                                        {{-- <td>  <div class="container1">
                                            <div class="switch-toggle">
                                                <input type="checkbox" id="write-{{$role->id}}" name="changepermission"
                                                    class="write" {{$role->hasPermissionTo('write post') ? 'checked' : ''}}
                                                    onchange="changepermission('write-{{$role->id}}')" >
                                                <label for="write-{{$role->id}}"></label>
                                            </div>
                                            <div class="switch-toggle">
                                                <input type="checkbox" id="edit-{{$role->id}}" name="changepermission"
                                                    class="edit" {{$role->hasPermissionTo('edit post') ? 'checked' : ''}}
                                                    onchange="changepermission('edit-{{$role->id}}')">
                                                <label for="edit-{{$role->id}}"></label>
                                            </div>
                                            <div class="switch-toggle">
                                                <input type="checkbox" id="publish-{{$role->id}}" name="changepermission"
                                                    class="publish" {{$role->hasPermissionTo('publish post') ? 'checked' : ''}}
                                                    onchange="changepermission('publish-{{$role->id}}')" >
                                                <label for="publish-{{$role->id}}"></label>
                                            </div>
                                        </td> --}}
                                        <td>
                                            @can('edit role')
                                            <a href="/role/{{$role->id}}/edit" class="btn"> <i
                                                class='fas fa-edit' style='font-size:24px; color:green'></i>
                                           </a>
                                           @endcan
                                     @if ($role->name == 'visitor')
                                     <button class="btn"> <i class="fa fa-close" style="font-size:24px; color:red"></i>
                                      </button>
                                      @else
                                      @can('delete role')
                                      <button class="btn " id="roledelete" value="{{$role->id}}"><i class='far fa-trash-alt'
                                        style='font-size:24px; color:red'></i>
                                      </button>
                                      @endcan
                                     @endif
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
    //  function changepermission(permission)
    //  {
    //     var state = $('#' + permission).is(':checked');
    //     var pr = permission.split('-')[0] + ' ' + 'post';
    //     var id = permission.split('-')[1];
    //     $.ajax({
    //         type: "patch",
    //         url: "role/permission/" + id,
    //         data: {
    //             "_token": "{{ csrf_token() }}",
    //             'state' : state,
    //             'permission' : pr
    //         },
    //         success: function (response) {
    //             console.log(response);
    //             window.location.reload();
    //         }
    //     });
    //  }
    $(document).ready(function () {

        $(document).on('click','#roleadd', function () {
            var role = $('#name').val();
            var per = [];
            $.each($("input[name='change']:checked"), function(){
                  per.push($(this).val());
              });
            //   console.log(per);
            $.ajax({
                type: "post",
                url: "role",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'name' : role,
                    'permission' : per
                },
                success: function (response) {
                    console.log(response);
                    window.location.reload();
                },
                error: function(dataResult) {
                    console.log(dataResult);
                    $error = dataResult.responseJSON.errors;
                    if (dataResult.status == 422) {
                        $.each($error, function(key,
                            value) {
                            $('#err-' + key).html(
                                value);
                        });
                    }
                }
            });
        });

        $(document).on('click', '#roledelete', function() {
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
                        type: 'delete',
                        url: "role/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results.success === true) {
                                swal.fire("Done!", results.message, "success");
                                window.location.reload();
                                // refresh page after 2 seconds
                                // setTimeout(function() {
                                //     location.reload();
                                // }, 2000);
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
