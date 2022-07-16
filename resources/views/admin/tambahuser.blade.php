@extends('kopi.master')
@section('title', 'Kopi Bubuk')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4 mt-4">
            <main class="form-signin">
                <h1 class="h3 mb-3 fw-normal text-center">Add User Form</h1>
                <form action="/adduser" method="post">
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
                            <option value="admin"> Admin</option>
                            <option value="pembeli">Pembeli</option>
                            <option value="penjual">Penjual</option>
                        </select>
                        <label for="role">Role</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-dark" type="submit">Add</button>
                </form>
            </main>
        </div>

    </div>

@endsection
