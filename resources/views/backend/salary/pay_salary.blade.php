@extends('dashboard')
@section('title', 'Pay Salary')

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
                            </ol>
                        </div>
                        <h4 class="page-title"><i class="mdi mdi-contactless-payment-circle-outline"></i> Pay Salary</h4>
                    </div>
                </div>
            </div>
            <br>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="header-title"><i class="mdi mdi-calendar-month-outline"></i> {{ date('F Y') }}
                            </h3>
                            <br>
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>image</th>
                                        <th>Name</th>
                                        <th>Month</th>
                                        <th>Salary</th>
                                        <th>Advance</th>
                                        <th>Due</th>
                                        <th>action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($employee as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ asset($item->image) }}" alt=""
                                                    style="width: 50px; height:40px;">
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td><span class="badge bg-info">{{ date('F', strtotime('-1 month')) }}</span>
                                            </td>
                                            <td>Rp. {{ $item->salary }}</td>
                                            <td>
                                                @if (isset($item['advance']) && $item['advance']['advance_salary'] !== null)
                                                    Rp. {{ $item['advance']['advance_salary'] }}
                                                @else
                                                    <p>No Advance</p>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $salary = (int) $item->salary;
                                                    $advance_salary =
                                                        isset($item['advance']) && $item['advance'] !== null
                                                            ? (int) $item['advance']['advance_salary']
                                                            : 0;
                                                    $amount = $salary - $advance_salary;
                                                @endphp
                                                <strong style="color: #fff;">Rp. {{ round($amount) }}</strong>
                                            </td>
                                            <td>
                                                <a href="{{ route('pay.now.salary', $item->id) }}"
                                                    class="btn btn-sm btn-blue waves-effect waves-light"><i
                                                        class="mdi mdi-credit-card-check-outline"></i> Pay Now</a>
                                            </td>
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
