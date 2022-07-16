@extends('kopi.dashboardlogin')
@section('title', 'Kopi Bubuk')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4 mt-4">
            <main class="form-signin">
                <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
                <form action="/register" method="post">
                    @csrf
                    <div class="form-floating">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            id="username" required value="{{ old('username') }}">
                        <label for="username">Username</label>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="email"name="email" class="form-control  @error('email') is-invalid @enderror"
                            id="email" required value="{{ old('email') }}">
                        <label for="email">Email address</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password"class="form-control  @error('password') is-invalid @enderror"
                            id="password">
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-2">
                        <select class="form-select" name="role" id="role" required value="{{ old('role') }}">
                            <option value="buyer">Buyer</option>
                            <option value="seller">Seller</option>
                        </select>
                        <label for="role">Role</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-dark" type="submit">Register</button>
                </form>
                <small class="d-block text-center mt-3 mb-3">Already Have an Account? <a href="login"> Login Now! </a>
                </small>
            </main>
        </div>

    </div>

@endsection
