@extends('dashboard')
@section('title', 'Barcode Product')

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
                                <li class="breadcrumb-item"><a href="{{ route('all.product') }}">Product</a></li>
                                <li class="breadcrumb-item active">Barcode</li>
                            </ol>
                        </div>
                        <h4 class="page-title"><i class="mdi mdi-account-group-outline"></i> Barcode Product</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-pane">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Product Code</label>
                                            <h3>{{ $product->product_code }}</h3>
                                        </div>
                                    </div>
                                    @php
                                        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">Product Barcode</label>
                                            <h3>{!! $generator->getBarcode($product->product_code, $generator::TYPE_CODE_128) !!}</h3>
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
