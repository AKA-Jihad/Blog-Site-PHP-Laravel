@extends('layouts.backendapp')

@section('title', 'Roles')

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
                            <h3>All Roles</h3>
                        </div>
                        <div class="card-body">
                            <table class="table text-center">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Permission</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>
                                            @foreach ($role->permissions as $permission)
                                                <span class="badge badge-success">{{$permission->name}}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
