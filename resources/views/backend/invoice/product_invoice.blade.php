@extends('dashboard')
@section('title', 'Product Invoice')

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <br><br>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Logo & title -->
                            <div class="clearfix">
                                <div class="float-start">
                                    <div class="auth-logo">
                                        <div class="logo logo-dark">
                                            <span class="logo-lg">
                                                <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt=""
                                                    height="22">
                                            </span>
                                        </div>

                                        <div class="logo logo-light">
                                            <span class="logo-lg">
                                                <img src="{{ asset('backend/assets/images/logo-light.png') }}"
                                                    alt="" height="22">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="float-end">
                                    <h4 class="m-0 d-print-none">Invoice</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mt-3">
                                        <h6>Billing Address</h6>
                                        <address>
                                            {{ $customer->name }}<br>
                                            {{ $customer->address }} - {{ $customer->city }} <br>
                                            <abbr title="Phone">Shop Name :</abbr> {{ $customer->shopname }} <br>
                                            <abbr title="Phone">Phone :</abbr> {{ $customer->phone }} <br>
                                            <abbr title="Phone">Email :</abbr> {{ $customer->email }} <br>
                                        </address>
                                    </div>
                                </div><!-- end col -->
                                <div class="col-md-6">
                                    <div class="mt-3 float-end">
                                        <p><strong>Order Date : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp;
                                                {{ date('d-F-Y') }}</span></p>
                                        <p><strong>Order Status : </strong> <span class="float-end"><span
                                                    class="badge bg-danger">Unpaid</span></span></p>
                                        <p><strong>Invoice No. : </strong> <span class="float-end">
                                                {{ 'EPOS' . mt_rand(10000000, 99999999) }}</span></p>
                                    </div>
                                </div><!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table mt-4 table-centered">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Item</th>
                                                    <th style="width: 10%">Qty</th>
                                                    <th style="width: 10%">Unit Cost</th>
                                                    <th style="width: 10%" class="text-end">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $s1 = 1;
                                                @endphp
                                                @foreach ($contents as $key => $item)
                                                    <tr>
                                                        <td>{{ $s1++ }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->qty }}</td>
                                                        <td>Rp.{{ $item->price }}</td>
                                                        <td class="text-end">Rp.{{ $item->price * $item->qty }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive -->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="clearfix pt-5">
                                        <h6 class="text-muted">Notes:</h6>

                                        <small class="text-muted">
                                            Barang sudah dicetak Struk Pembelian tidak bisa dikembalikan.
                                        </small>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="float-end">
                                        <p><b>Sub-total :</b> <span class="float-end">Rp.{{ Cart::subtotal() }}</span></p>
                                        <p><b>Discount (15%) :</b> <span class="float-end"> &nbsp;&nbsp;&nbsp;
                                                Rp.{{ Cart::tax() }}</span>
                                        </p>
                                        <p><b>Total :</b> <span class="float-end"> &nbsp;&nbsp;&nbsp;
                                                Rp.{{ Cart::total() }}</span>
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="mt-4 mb-1">
                                <div class="text-end d-print-none">
                                    <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i
                                            class="mdi mdi-printer me-1"></i> Print</a>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#invoice-modal">Create Invoice</button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    {{-- Modals Store --}}
    <div id="invoice-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="text-center mt-2 mb-4">
                        <h4>Infoice Of {{ $customer->name }}</h4>
                        <h4>Total Pembayaran Rp.{{ Cart::total() }}</h4>
                    </div>

                    <form class="px-3" action="{{ route('final.invoice') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Payment</label>
                            <select name="payment_status" class="form-select">
                                <option selected disabled>Select Payment</option>
                                <option value="HandCash">HandCash</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Due">Due</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Pay Now</label>
                            <input class="form-control" type="text" required="" name="pay" placeholder="Pay Now">
                        </div>
                        <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                        <input type="hidden" name="order_date" value="{{ date('d-F-Y') }}">
                        <input type="hidden" name="order_status" value="pending">
                        <input type="hidden" name="total_product" value="{{ Cart::count() }}">
                        <input type="hidden" name="sub_total" value="{{ Cart::subtotal() }}">
                        <input type="hidden" name="vat" value="{{ Cart::tax() }}">
                        <input type="hidden" name="total" value="{{ Cart::total() }}">

                        <div class="mb-3 text-center">
                            <button class="btn btn-primary" type="submit">Complete Order</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
