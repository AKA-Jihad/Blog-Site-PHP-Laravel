@extends('layouts.backendapp')

@section('title', 'Create Role')

@section('content')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-end">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
                <h1 class="m-0">Dashboard</h1>
            </div>

        </div>
    </div>

    <div class="container-fluid page__container">

        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-end">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Role & Permission</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">Role & Permission</h1>
                </div>

            </div>
        </div>

        <div class="container-fluid page__container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Role</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('backend.role.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Role Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    @foreach ($permissions as $permission)
                                        <label class="col-md-2 border py-1 px-2">
                                            <input type="checkbox" name="permisison[]" value="{{$permission->id}}"> {{ $permission->name }}
                                        </label>
                                    @endforeach


                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3>Permission</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('backend.permission.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Permission Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
