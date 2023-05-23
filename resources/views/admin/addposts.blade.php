<x-layout>
    <x-nav />
    <x-sidebar />
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Post</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <form action="/posts" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Title</label>
                                                <input type="text" name="title" id="title"
                                                    class="form-control" value="{{ old('title') }}">
                                                @error('title')
                                                    <p class="text-red-500 mt-1 text-xm" style="color:red"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Category</label>
                                                <select class="form-control" name="category_id" id="category">
                                                    @php
                                                        $categories = App\Models\Category::all();
                                                    @endphp
                                                    @foreach ($categories as $category)
                                                        <option value=" {{ $category->id }} " {{ old('category_id') == $category->id ? 'selected' : '' }} >
                                                            {{ ucwords($category->name) }} </option>
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                <p class="text-red-500 mt-1 text-xm" style="color:red"> {{ $message }} </p>
                                            @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Excerpt</label>
                                        <textarea class="form-control" name="excerpt" id="excerpt" rows="2"> {{ old('excerpt') }} </textarea>
                                        @error('excerpt')
                                        <p class="text-red-500 mt-1 text-xm" style="color:red"> {{ $message }} </p>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Body</label>
                                        <textarea id="summernote" name="body"> {{ old('body') }} </textarea>
                                        @error('body')
                                        <p class="text-red-500 mt-1 text-xm" style="color:red"> {{ $message }} </p>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Image</label>
                                        <input type="file" class="dropify" name="image" id="image" value=" {{ old('image') }} " />
                                        @error('image')
                                        <p class="text-red-500 mt-1 text-xm" style="color:red"> {{ $message }} </p>
                                    @enderror
                                    </div>
                                    <button type="submit" id="addpost" class="btn btn-primary btn-lg">Save</button>
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
        $('#summernote').summernote();

        // $(document).on('click', '#addpost', function() {

        //     var title = $('#title').val();
        //     var category = $('#category').val();
        //     var excerpt = $('#excerpt').val();
        //     var body = $('#summernote').val();
        //     var image = $('#image').val();

        //     console.log(image);
        //     $.ajax({
        //         type: "POST",
        //         url: "posts/store",
        //         data: {
        //             "_token": "{{ csrf_token() }}",
        //             'title': title,
        //             'category_id': category,
        //             'excerpt': excerpt,
        //             'body': body,
        //             'image': image
        //         },
        //         success: function(response) {
        //             console.log(response);
        //         },
        //         error: function(dataResult) {
        //             console.log(dataResult);
        //             $error = dataResult.responseJSON.errors;
        //             if (dataResult.status == 422) {
        //                 $.each($error, function(key, value) {
        //                     $('#err-' + key).html(value);
        //                 });
        //             }
        //         }
        //     });

        // });

    });
</script>