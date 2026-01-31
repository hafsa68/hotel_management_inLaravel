@extends("backend.layouts.app")
@section("head")

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Dashtrap - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="assets/libs/morris.js/morris.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/config.js"></script>
</head>
@endsection
@section("content")




<div class="container-fluid">


    <!-- start page title -->
    <div class="page-content">


        <!-- ========== Topbar End ========== -->

        <div class="px-3">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="py-3 py-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            @if(session('success'))
                             
                                    <div class="alert alert-success">{{session('success')}}</div>
                            @endif
                            
                            <h4 class="page-title mb-0">Category List <span class="float-end"><a href="{{url('category/create')}}" class="btn btn-primary">Add Category</a></span></h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Category</a></li>
                                    <li class="breadcrumb-item active">Category</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <!--- end row -->


                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Category List</h4>


                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($cats as $cat)
                                            <tr>
                                                <form action="{{route('category.destroy',$cat->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                <th scope="row">{{$cat->id}}</th>
                                                <td>{{$cat->name}}</td>
                                                <td>

                                                    <a href="{{route('category.edit',$cat->id)}}" class="btn btn-light">Edit</a>

                                                    <button type="submit" href="" class="btn btn-light">delete</button>

                                                </td>
</form>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->
                            </div>
                        </div> <!-- end card -->
                    </div> <!-- end col -->


                </div>
                <!-- end row -->



                <!-- end row -->






                <!--- end row -->


            </div> <!-- container -->

        </div> <!-- content -->


        <!-- end Footer -->

    </div>
    <!--end row-->


    <!--end row-->

</div>


@endsection

@section("scripts")
<script src="assets/js/vendor.min.js"></script>
<script src="assets/js/app.js"></script>

<!-- Knob charts js -->
<script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>

<!-- Sparkline Js-->
<script src="assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

<script src="assets/libs/morris.js/morris.min.js"></script>

<script src="assets/libs/raphael/raphael.min.js"></script>

<!-- Dashboard init-->
<script src="assets/js/pages/dashboard.js"></script>
@endsection