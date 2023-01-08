@extends('layouts.backendapp')

@section('title', "Category")

@section('content')

<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-end">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{route('backend.home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Post</li>
                </ol>
            </nav>
            <h1 class="m-0">Post</h1>
        </div>

    </div>
</div>

<div class="container-fluid page__container">

<div class="row">
    <div class="col-lg-12">
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
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                                @forelse ($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>
                                        @if ($post->image)
                                            <img width="40" src="{{asset('storage/post/'.$post->image)}}" alt="{{$post->title}}">
                                        @else
                                        <img src="{{Avatar::create($post->title)->setDimension(40)->setFontSize(16)->toBase64()}}" alt="">
                                        @endif
                                    </td>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->slug}}</td>
                                    <td>{{$post->category->name}}</td>
                                    <td>{{$post->status}}</td>
                                    <td>{{$post->created_at->diffForHumans()}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">Post Not Found!</td>
                                </tr>
                                @endforelse
                            </thead>
                        </table>
                        <div class="border pt-3 px-3 mt-3">
                            {{ $posts->links() }}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="deactive">
                        Deactive
                    </div>
                    <div class="tab-pane fade" id="trash">

                    </div>
                  </div>
                {{-- Tab End --}}



                
            </div>
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