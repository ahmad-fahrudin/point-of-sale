@extends('dashboard')
@section('title', 'Year Expense')

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
                                <li class="breadcrumb-item"><a href="{{ route('add.expense') }}"
                                        class="btn btn-primary rounded-pill waves-effect waves-light"><i
                                            class="mdi mdi-account-arrow-left-outline"></i> Add Expense</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><i class="mdi mdi-account-group-outline"></i> Year Expense</h4>
                    </div>
                </div>
            </div>
            <br>
            <!-- end page title -->

            @php
                $year = date('F');
                $expenseyear = App\Models\Expense::where('year', $year)->sum('amount'); //var sum itu penjumlahan
            @endphp

            <h4 class="header-title">Year Expense</h4>
            <h4 style="color:whitesmoke; font-size:30px;" align="center">Total : Rp.{{ $expenseyear }}</h4>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Details</th>
                                        <th>Amount</th>
                                        <th>Year</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($yearexpense as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->details }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ $item->year }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
