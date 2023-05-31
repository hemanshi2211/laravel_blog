<x-layout>
<x-nav/>
<x-sidebar/>

<div class="content-wrapper">
    <section class="content mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form >
                                @csrf
                            <div class="form-group">
                              <label for="">Role</label>
                              <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" id="selectall" class="form-check-input" name="" id="" value="" >
                                Select All
                              </label>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Category Permission</label>
                                      </div>
                                     <x-permission find="category" page="add page"/>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Post Permission</label>
                                      </div>
                                      <x-permission find="post" page="add page"/>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">User Permission</label>
                                      </div>
                                      <x-permission find="user" page="add page"/>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Role Permission</label>
                                      </div>
                                      <x-permission find="role" page="add page"/>
                                </div>
                            </div>
                            <br>
                            <input name="" id="submitbtn" class="btn btn-primary" type="button" value="submit">
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
    $(document).ready(function () {
        $(document).on('click','#submitbtn', function () {
             var name = $('#name').val();
             var per = [];
            $.each($("input[name='permission']:checked"), function(){
                  per.push($(this).val());
              });
             console.log(per);
             $.ajax({
                type: "post",
                url: "/role",
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
        $('#selectall').click(function() {
        if ($(this).prop('checked')) {
            $('.hemanshi').prop('checked', true);
        } else {
            $('.hemanshi').prop('checked', false);
        }
    });
    });
</script>
