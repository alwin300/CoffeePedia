@extends('kopi.master')
@section('content')
    <div class="row row col-lg-12 mt-1">
        <h2 align="center"> CoffeeInfo </h2>
    </div>
    @if (auth()->user()->role == 'admin')
        <div class="row col-lg-2 mb-3 d-md-block">
            <a href="tambahdatacoffeeinfo" class="btn btn-outline-secondary"> <span data-feather="plus-square"></span> Add
                CoffeeInfo</a>
        </div>
    @endif
    <div class="col-md-6">
        <form action="/coffeeinfo">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search.." name="search"
                    value="{{ request('search') }}"> &nbsp;
                <button class="btn btn-dark" type="submit">Search</button>
            </div>
        </form>
    </div>

    <div class="col-lg-6" role="alert">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    @foreach ($datacoffeeinfo as $p)
        <a href="coffeeinfo/{{ $p->id }}"class="card p-1" style="text-decoration:none; border:none;">
            <div class="card" style="height: 14rem;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $p->image) }}" class="rounded" style="height: 14rem;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title text-dark">{{ $p->judul }}</h4>

                            <h5 class="card-tittle text-dark">
                                <p> {!! Str::limit($p->deskripsi, 300) !!} </p>
                            </h5>
                            @if (auth()->user()->role == 'admin')
                                <td><a href="coffeeinfo/edit/{{ $p->id }}"class="btn btn-dark"> <span
                                            data-feather="edit-2"></span></a> &nbsp;
                                <td><a href="coffeeinfo/delete/{{ $p->id }}"class="btn btn-dark"> <span
                                            data-feather="trash"></span></a> &nbsp;
                            @endif
                            </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </a>
    @endforeach
    <div mt-5>
        {{ $datacoffeeinfo->links() }}
    </div>
@endsection
