@extends('layouts.backendapp')

@section('title')
{{$category->name}}
@endsection

@section('content')

<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-end">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{route('backend.home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$category->name}}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{$category->name}}</h1>
        </div>

    </div>
</div>

<div class="container-fluid page__container">

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">



                <table class="table">
                     <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{$category->name}}</td>
                     </tr>
                     <tr>
                        <td>Description</td>
                        <td>:</td>
                        <td>{{$category->description}}</td>
                     </tr>
                </table>

                
                
            </div>
        </div>



        <div class="card mt-5">
            <div class="card-header">
                <h3>Posts</h3>
            </div>
            <div class="card-body">
                

                @foreach ($category->posts as $post)
                    
                @endforeach
                <h3><a href="">{{$post->title}}</a></h3>


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