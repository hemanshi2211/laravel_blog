<x-layout>
    <x-nav />
    <x-sidebar />
    <div class="content-wrapper">
        <section class="content mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        {{-- {{dd($rolePermission)}} --}}
                        <div class="card">
                            <div class="card-body">
                                <form>
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Role</label>
                                        <input type="text" name="name" id="name" value="{{ $role->name }}"
                                            class="form-control" placeholder="" aria-describedby="helpId">
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" id="selectall" class="form-check-input"
                                                name="" id="" value="">
                                            Select All
                                        </label>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Category Permission</label>
                                            </div>
                                            <x-permission find="category" page="edit page" :rolePermission="$rolePermission" />
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Post Permission</label>
                                            </div>
                                            <x-permission find="post" page="edit page" :rolePermission="$rolePermission" />
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">User Permission</label>
                                            </div>
                                            <x-permission find="user" page="edit page" :rolePermission="$rolePermission" />
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Role Permission</label>
                                            </div>
                                            <x-permission find="role" page="edit page" :rolePermission="$rolePermission" />
                                        </div>
                                    </div>
                                    <br>
                                    <button type="button" id="update" class="btn btn-primary" value="{{$role->id}}">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layout>
<script>
    $(document).ready(function() {

        $(document).on('click','#update', function () {
            var name = $('#name').val();
            var per = [];
            var id = $(this).val();
            $.each($("input[name='permission']:checked"), function(){
                  per.push($(this).val());
              });
              $.ajax({
                type: "patch",
                url: "/role/"+id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    'name' : name,
                    'permission' : per
                },
                success: function (response) {
                    console.log(response);
                    window.location.href = '/role';
                }
             });
        });

        var per = [];
        var allval = [];
        $.each($("input[name='permission']:checked"), function() {
            per.push($(this).val());
        });
        $('.hemanshi').each(function() {
            allval.push($(this).val());
        });
        console.log(per);
        $('#selectall').click(function() {
            if ($(this).prop('checked')) {
                $('.hemanshi').prop('checked', true);
            } else {
                console.log(per);
                $.each($(".hemanshi"), function() {
                    if(per.includes($(this).val()))
                    {
                        $(this).checked;
                    }
                    else
                    {
                        $(this).prop('checked',false);
                    }
                });
            }
        });
    });
</script>
