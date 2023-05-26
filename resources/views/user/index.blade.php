@role('admin')
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
                            <h1>All Users <button name="" id="" data-toggle="modal" data-target="#addmodal"
                                class="btn btn-primary float-right" type="button"> <i class='fas fa-solid fa-user-plus'></i> </button></h1>
                            <table id="myTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th style="text-align: center;">Permission<br/><span class="p-4 ml-2">write</span><span class="p-5 ml-4">edit</span><span class="ml-5">publish</span></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    @if ($user->name == 'admin')
                                        @continue
                                    @endif
                                        <tr>
                                            <td> {{$user->name}} </td>
                                            <td> {{$user->email}} </td>
                                            <td> {{ucwords($user->getRoleNames()[0])}} </td>
                                            <td>  <div class="container1">
                                                <div class="switch-toggle">
                                                    <input type="checkbox" id="write-{{$user->id}}" name="changepermission"
                                                        class="write" {{ $user->hasPermissionTo('write post') ? 'checked' : ' '}}
                                                    onchange="editpermission('write-{{$user->id}}')" {{$user->hasRole('visitor') ?
                                                    'disabled' : ' ' }}>
                                                    <label for="write-{{$user->id}}"></label>
                                                </div>
                                                <div class="switch-toggle">
                                                    <input type="checkbox" id="edit-{{$user->id}}" name="changepermission"
                                                        class="edit" {{ $user->hasPermissionTo('edit post') ? 'checked' : ' '}}
                                                    onchange="editpermission('edit-{{$user->id}}')" {{$user->hasRole('visitor') ?
                                                    'disabled' : ' ' }}>
                                                    <label for="edit-{{$user->id}}"></label>
                                                </div>
                                                <div class="switch-toggle">
                                                    <input type="checkbox" id="publish-{{$user->id}}" name="changepermission"
                                                        class="publish" {{ $user->hasPermissionTo('publish post') ? 'checked' : '
                                                    '}} onchange="editpermission('publish-{{$user->id}}')"
                                                    {{$user->hasRole('visitor') ? 'disabled' : ' ' }}>
                                                    <label for="publish-{{$user->id}}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn" id="useredit" value="{{$user->id}}"> <i
                                                        class='fas fa-edit' style='font-size:24px; color:green'></i>
                                                </button>
                                                <button class="btn " id="deleteuser" value="{{$user->id}}"> <i
                                                        class='far fa-trash-alt'
                                                        style='font-size:24px; color:red'></i>
                                                </button>
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
        <!--add Modal -->
        <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Add User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" id="addname" class="form-control" placeholder="user name" aria-describedby="helpId">
                              <p class="text-red " id="2err-name"></p>
                                  </div>
                                  <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" name="email" id="addemail" aria-describedby="emailHelpId" placeholder="user email">
                              <p class="text-red " id="2err-email"></p>
                                  </div>
                                  <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="user password">
                              <p class="text-red " id="2err-password"></p>
                                  </div>
                                  <div class="form-group">
                                    <label for="">Role</label>
                                  <div class="form-check">
                                    <label class="form-check-label">
                                        @php
                                            $roles = Spatie\Permission\Models\Role::all();
                                            // dd($roles);
                                        @endphp
                                        @foreach ($roles as $role)
                                        <input type="radio" class="form-check-input" name="role" id="" value="{{$role->name}}">
                                         {{$role->name}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
                                        @endforeach
                                    </label>
                              <p class="text-red " id="2err-role"></p>
                                  </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="adduser" class="btn btn-primary">Save</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="editusermodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form>
                                <div class="form-group">
                                  <label for="">Name</label>
                                  <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="helpId">
                            <p class="text-red " id="err-name"></p>
                                </div>
                                <div class="form-group">
                                  <label for="">Email</label>
                                  <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="">
                            <p class="text-red " id="err-email"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Role</label>
                                  <div class="form-check">
                                    <label class="form-check-label">
                                        @foreach ($roles as $role)
                                        <input type="radio" class="form-check-input" name="editrole" id="" value="{{$role->name}}">
                                         {{$role->name}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br/>
                                        @endforeach
                                    </label>
                              <p class="text-red " id="2err-role"></p>
                                  </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="updateuser" class="btn btn-primary">Update</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>
</div>
</x-layout>
<script>
    function editpermission(permission)
    {
        var state = $('#' + permission).is(':checked');
        var pr = permission.split('-')[0] + ' ' + 'post';
        var id = permission.split('-')[1];
        console.log(pr);
        $.ajax({
            type: "patch",
            url: "user/state/" + id,
            data: {
                "_token": "{{ csrf_token() }}",
                'state' : state,
                'permission' : pr
            },
            success: function (response) {
                console.log(response);
                window.location.reload();
            }
        });
    }
    $(document).ready(function () {
        $(document).on('click','#adduser', function () {
            var name = $('#addname').val();
            var email = $('#addemail').val();
            var password = $('#password').val();
            var role = $('input[type="radio"]:checked').val();
            $.ajax({
                type: "post",
                url: "user",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'name' : name,
                    'email' : email,
                    'password' : password,
                    'role' : role
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
                            $('#2err-' + key).html(
                                value);
                        });
                    }
                }
            });
        });
        $(document).on('click','#useredit', function () {
            var id = $(this).val();
            // console.log(id);
            $.ajax({
                type: "get",
                url: "user/" + id + "/edit",
                data: "data",
                success: function (response) {
                    console.log(response);
                    $('#editusermodal').modal('show');
                    $('#name').val(response.user.name);
                    $('#email').val(response.user.email);
                    $('#updateuser').val(response.user.id);
                    $("input[type='radio'][value=" + response.role + "]").prop('checked',
                        true);
                }
            });
        });
        $(document).on('click','#updateuser', function () {
            var id = $(this).val();
            var name = $('#name').val();
            var email = $('#email').val();
            var role = $('input[name="editrole"]:checked').val();
            $.ajax({
                type: "patch",
                url: "user/"+ id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    'name' : name,
                    'email' : email,
                    'role' : role
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
        $(document).on('click', '#deleteuser', function() {
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
                        url: "user/" + id,
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
                                }, 100);
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
@endrole
