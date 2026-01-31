@extends("backend.layouts.app")
@section("head")
<head>
        <meta charset="utf-8" />
        <title>Form Elements | Dashtrap - Responsive Bootstrap 5 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Myra Studio" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{url('')}}/assets/images/favicon.ico">

		<!-- App css -->
		<link href="{{url('')}}/assets/css/style.min.css" rel="stylesheet" type="text/css">
		<link href="{{url('')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css">
		<script src="{{url('')}}/assets/js/config.js"></script>

    </head>
@endsection
@section("content")

<div class="container-fluid">


                  <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="py-3 py-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="page-title mb-0">Form Elements</h4>
                                </div>
                                <div class="col-lg-6">
                                   <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                        <li class="breadcrumb-item active">Form Elements</li>
                                    </ol>
                                   </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <!-- end row -->

                       
                        <!-- end row -->


                        
                        <!-- end row -->


                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Category Entry Form</h4>
                                        @if($errors->any())
<div class="alert alert-danger">
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach

</div>
  @endif
                                        
                                        <form role="form" method="post" action="{{route('category.store')}}">
                                            @csrf
                                            <div class="mb-2">
                                                <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                                <input type="text" value="{{old('cat')}}" name="cat" class="form-control"  placeholder="Enter category name">
                                               
                                            </div>
                                            
                                         
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                           
                        </div>
                        <!-- end row -->


                        <!-- Inline Form -->
                      
                        <!-- end row -->


                        <!-- Form row -->
                       
                        <!-- end row -->
                        
                    </div> 
                 
                    <!--end row-->

                </div>


@endsection

@section("scripts")
  <script src="{{url('')}}/assets/js/vendor.min.js"></script>
        <script src="{{url('')}}/assets/js/app.js"></script>
        <script src="assets/libs/morris.js/morris.min.js"></script>

        
@endsection