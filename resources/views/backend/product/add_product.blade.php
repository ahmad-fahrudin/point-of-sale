@extends('dashboard')
@section('title', 'Add Product')

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="#">Product</a></li>
                                <li class="breadcrumb-item active">Add</li>
                            </ol>
                        </div>
                        <h4 class="page-title"><i class="mdi mdi-account-group-outline"></i> Add Product</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-pane">
                                <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data"
                                    id="myForm">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="name" class="form-label">Product Name</label>
                                                <input type="text" class="form-control" id="name" value=""
                                                    name="product_name" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Category Name</label>
                                                <select class="form-select" name="category_id" id="">
                                                    <option selected disabled>Select Category</option>
                                                    @foreach ($category as $cat)
                                                        <option value="{{ $cat->id }}">{{ $cat->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Product Garage</label>
                                                <input type="text" class="form-control" id="" value=""
                                                    name="product_garage">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="email" class="form-label">Supplier Name</label>
                                                <select class="form-select" name="supplier_id" id="">
                                                    <option selected disabled>Select Supplier</option>
                                                    @foreach ($supplier as $sup)
                                                        <option value="{{ $sup->id }}">{{ $sup->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Product Store</label>
                                                <input type="text" class="form-control" id="" value=""
                                                    name="product_store">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Buying Date</label>
                                                <input type="date" name="buying_date" id="date"
                                                    class="checkdate form-control form-control-sm singledatepicker"
                                                    placeholder="Buying Date" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Expire Date</label>
                                                <input type="date" name="expire_date" id="date"
                                                    class="checkdate form-control form-control-sm singledatepicker"
                                                    placeholder="Expire Date" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="image" class="form-label">Image</label>
                                                <input type="file" id="image" class="form-control"
                                                    name="product_image">

                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <img src="{{ url('upload/no_image.jpg') }}"
                                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image"
                                                    id="showImage">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Buying Price</label>
                                                <input type="text" class="form-control" id="" value=""
                                                    name="buying_price">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Selling Price</label>
                                                <input type="text" class="form-control" id="" value=""
                                                    name="selling_price">
                                            </div>
                                        </div>
                                    </div> <!-- end row -->
                                    <div class="text-start">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end settings content-->
                        </div> <!-- end tab-content -->
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
    <script class="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    product_name: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    product_garage: {
                        required: true,
                    },
                    supplier_id: {
                        required: true,
                    },
                    product_store: {
                        required: true,
                    },
                    buying_date: {
                        required: true,
                    },
                    buying_price: {
                        required: true,
                    },
                    selling_price: {
                        required: true,
                    },
                    product_image: {
                        required: true,
                    },
                },
                messages: {
                    product_name: {
                        required: 'Please enter Product Name',
                    },
                    category_id: {
                        required: 'Please select Category',
                    },
                    product_garage: {
                        required: 'Please enter Product Garage',
                    },
                    supplier_id: {
                        required: 'Please select Supplier',
                    },
                    product_store: {
                        required: 'Please enter Product Store',
                    },
                    buying_date: {
                        required: 'Please select Buying Date',
                    },
                    buying_price: {
                        required: 'Please enter Buying Price',
                    },
                    selling_price: {
                        required: 'Please enter Selling Price',
                    },
                    product_image: {
                        required: 'Please enter Product Image',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
