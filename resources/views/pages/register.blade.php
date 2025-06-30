<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.auth._head', ['title' => 'Register'])
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <h3 class="brand-logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('img/logo.png') }}" width="220" alt="logo" />
                                </a>
                            </h3>
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                            <form class="pt-3" action="{{ route('auth.register') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name='name'
                                        placeholder="Full Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" name="email"
                                        placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <select name="role" class="form-control form-control-lg" required>
                                        <option value="" disabled selected>Pilih Daftar Sebagai</option>
                                        <option value="teacher">Guru</option>
                                        <option value="student">Murid</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password"
                                        placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation"
                                        class="form-control form-control-lg" placeholder="Confirm Password" required>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                        SIGN UP
                                    </button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="{{ route('auth.login') }}"
                                        class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('partials._toastr')
    <script src="{{ asset('/dashboard/js/vendor.bundle.base.js') }}"></script>

    <!-- TOASER -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>
