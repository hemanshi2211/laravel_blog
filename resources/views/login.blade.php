<x-layout>
    <div class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="#" class="h1"><b>Admin</b>LTE</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form action="/login" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email">
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
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                        </div>
                    </form>
                    {{-- <p class="mb-1">
                        <a href="forgot-password.html">I forgot my password</a>
                    </p> --}}
                    <p class="mb-0">
                        <a href="/registration/create" class="text-center">Register a new membership</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-layout>
