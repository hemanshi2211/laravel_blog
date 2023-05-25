<x-layout>
    <div class="hold-transition login-page">
        <div class="register-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="#" class="h1"><b>Admin</b>LTE</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Register a new membership</p>

                    <form action="{{ route('register.store') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Full name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        @error('name')
                        <p class="text-red-500 mt-1 text-xm" style="color:red"> {{ $message }} </p>
                    @enderror
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('email')
                            <p class="text-red-500 mt-1 text-xm" style="color:red"> {{ $message }} </p>
                        @enderror
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                            <p class="text-red-500 mt-1 text-xm" style="color:red"> {{ $message }} </p>
                        @enderror
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="cpass" placeholder="Retype password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('cpass')
                            <p class="text-red-500 mt-1 text-xm" style="color:red"> {{ $message }} </p>
                        @enderror
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <div class="social-auth-links text-center">
                        <a href="#" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i>
                            Sign up using Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i>
                            Sign up using Google+
                        </a>
                    </div>

                    <a href="login" class="text-center">I already have a membership</a>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
        <!-- /.register-box -->
    </div>
</x-layout>
