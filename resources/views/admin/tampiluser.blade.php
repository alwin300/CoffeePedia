@extends('kopi.master')
@section('title', 'Kopi Bubuk')
@section('content')
    <div class ="row row col-lg-12 mt-1">
        <h2 align="center"> List User </h2>
    </div>
    <div class="row col-lg-2 mb-3 d-md-block">
        <br> <br>
        <a href="user/add" class="btn btn-outline-secondary"> <span data-feather="plus-square"></span> Add user</a>
    </div>
    <div class="col-lg-6" role="alert">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="row col-lg-11">
        <table class="table table-striped shadow">
            <tr>
                <th align="center">Username</th>
                <th align="center">Email</th>
                <th align="center">Role</th>
                <th align="center">No.Telephone</th>
                <th align="center">Address</th>
                <th align="center">Bank Account Number</th>
            </tr>
            @foreach ($user as $users)
                <tr>
                    <td>{{ $users->username }}</td>
                    <td> {{ $users->email }} </td>
                    <td>{{ $users->role }}</td>
                    <td> {{ $users->notelpon }} </td>
                    <td> {{ $users->alamat }} </td>
                    <td>{{ $users->norek }}</td>

                </tr>
            @endforeach
        </table>
        {{-- <div mt-5>
		{{ $users->links() }}
	</div> --}}
    </div>
@endsection
