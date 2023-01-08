@extends('layouts.backendapp')

@section('title', "Category")

@section('content')

<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-end">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{route('backend.home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                </ol>
            </nav>
            <h1 class="m-0">Category</h1>
        </div>

    </div>
</div>

<div class="container-fluid page__container">

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">


                {{-- Tab Start --}}
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#active" type="button">Active</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#deactive" type="button">Deactive</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#trash" type="button">Trash</button>
                    </li>
                  </ul>
                  <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="active">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Count</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td><img width="50" src="{{asset('storage/category/' . $category->image)}}" alt="{{$category->name}}"></td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->slug}}</td>
                                    <td>{{$category->post_counts}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{route('category.show', $category->id)}}">View</a>
                                        <a class="btn btn-sm btn-info" href="">Edit</a>
                                        <form class="d-inline" action="{{route('category.delete', $category->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="border pt-3 px-3 mt-3">
                            {{ $categories->links() }}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="deactive">
                        Deactive
                    </div>
                    <div class="tab-pane fade" id="trash">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Count</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                @foreach ($trashCategories as $category)

                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>
                                        @if ($category->image){}
                                        <img width="50" src="{{asset('storage/category/' . $category->image)}}" alt="{{$category->name}}">
                                        @else
                                        <img src="{{Avatar::create($category->name)->setDimension(40)->setFontSize(16)->toBase64()}}" alt="">
                                        @endif
                                        
                                    </td>
                                    <td>{{$category->name}}</td>
                                    <td>{{count($category->posts)}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="{{route('category.restore', $category->id)}}">Restore</a>
                                        <form class="d-inline" action="{{route('category.permanent.delete', $category->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger permanent_delete">Permanent Delete</button>
                                        </form>
                                    </td>
                                </tr>

                            

                                @endforeach
                            </tbody>
                        </table>
                        <div class="border pt-3 px-3 mt-3">
                            {{ $trashCategories->links() }}
                        </div>
                    </div>
                  </div>
                {{-- Tab End --}}



                
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4">
    <div class="card">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        
        <div class="card-body">
            <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="form-group">
                <label for="">Category Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" placeholder="Category Name">
            </div>
            <div class="form-group">
                <label for="">Parent</label>
                <select name="parent" id="" class="form-control select_2">
                    <option selected disabled>Select Parent</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="form-control" rows="5" placeholder="Description"></textarea>
            </div>
            <div class="form-group">
                <label for="">Category Image<span class="text-danger">*</span></label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary">Create <i class="fa fa-plus"></i></button>
            </div>
            </form>
        </div>
    </div>
</div>



</div>
@endsection 





@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.js"></script>

    <script>
    $(document).ready(function() {
        $('.select_2').select2();
})
    });</script>
    

    <script>
        $('.permanent_delete').on('click', function(){
            Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    $(this).parent().submit();
  }
})
        });
    </script>

    
    @if (Session::has('success'))
    <script>
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Category has been added!',
        showConfirmButton: false,
        timer: 1500
    })

    // permanently delete alert
    

    </script>

    
@endif

@endsection