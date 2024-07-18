@extends('dashboard')
@section('title', 'Details Supplier')

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
                                <li class="breadcrumb-item"><a href="#">Supplier</a></li>
                                <li class="breadcrumb-item active">Details</li>
                            </ol>
                        </div>
                        <h4 class="page-title"><i class="mdi mdi-truck-outline"></i> Details Supplier</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-10 col-xl-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-pane">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="mb-3">
                                            <img src="{{ asset($supplier->image) }}" class="avatar-lg img-thumbnail"
                                                alt="profile-image">
                                            <h4 class="mb-0">{{ $supplier->name }}</h4>
                                            <br>
                                            <h5 class="text-muted">{{ $supplier->email }}</h5>
                                            <p class="text-muted">{{ $supplier->type }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Phone</label>
                                            <p class="text-danger">{{ $supplier->phone }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Address</label>
                                            <p class="text-danger">{{ $supplier->address }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Shop Name</label>
                                            <p class="text-danger">{{ $supplier->shopname }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Account Holder</label>
                                            <p class="text-danger">{{ $supplier->account_holder }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Account Number</label>
                                            <p class="text-danger">{{ $supplier->account_number }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Bank Name</label>
                                            <p class="text-danger">{{ $supplier->bank_name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Bank Branch</label>
                                            <p class="text-danger">{{ $supplier->bank_branch }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">City</label>
                                            <p class="text-danger">{{ $supplier->city }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end settings content-->
                        </div> <!-- end tab-content -->
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->
@endsection
