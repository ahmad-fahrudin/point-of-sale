@extends('dashboard')
@section('title', 'Paid Salary')

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
                                <li class="breadcrumb-item"><a href="#">Paid Salary</a></li>
                                <li class="breadcrumb-item active">Paid</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Paid Salary</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-pane">
                                <form method="POST" action="{{ route('employee.salary.store') }}">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $paysalary->id }}">
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>Paid
                                        Salary
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="experience" class="form-label">Employee Name</label>
                                                <strong style="color: #fff;">{{ $paysalary->name }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="month" class="form-label">Salary Month</label>
                                                <strong style="color: #fff;">{{ date('F', strtotime('-1 month')) }}</strong>
                                                <input type="hidden" name="salary_month"
                                                    value="{{ date('F', strtotime('-1 month')) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="paid_amount" class="form-label">Employee Salary</label>
                                                <strong style="color: #fff;">{{ $paysalary->salary }}</strong>
                                                <input type="hidden" name="paid_amount" value="{{ $paysalary->salary }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="advance_salary" class="form-label">Advance Salary</label>
                                                <strong style="color: #fff;">
                                                    @if (isset($paysalary['advance']) && $paysalary['advance']['advance_salary'] !== null)
                                                        {{ $paysalary['advance']['advance_salary'] }}
                                                    @else
                                                        <p>No Advance</p>
                                                    @endif
                                                </strong>
                                                <input type="hidden" name="advance_salary"
                                                    value="@if (isset($paysalary['advance']) && $paysalary['advance']['advance_salary'] !== null) {{ $paysalary['advance']['advance_salary'] }} @endif">
                                            </div>
                                        </div>
                                        @php
                                            $salary = (int) $paysalary->salary;
                                            $advance_salary =
                                                isset($paysalary['advance']) && $paysalary['advance'] !== null
                                                    ? (int) $paysalary['advance']['advance_salary']
                                                    : 0;
                                            $amount = $salary - $advance_salary;
                                        @endphp

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="advance_salary" class="form-label">Due Salary</label>
                                                <strong style="color: #fff;">
                                                    @if (isset($paysalary['advance']) && $paysalary['advance']['advance_salary'] !== null)
                                                        {{ round($amount) }}
                                                    @else
                                                        {{ $paysalary->salary }}
                                                    @endif
                                                </strong>
                                                <input type="hidden" name="due_salary"
                                                    value="@if (isset($paysalary['advance']) && $paysalary['advance']['advance_salary'] !== null) {{ round($amount) }} @endif">
                                            </div>
                                        </div>

                                    </div> <!-- end row -->
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-email-check-outline"></i> Paid Salary</button>
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
@endsection
