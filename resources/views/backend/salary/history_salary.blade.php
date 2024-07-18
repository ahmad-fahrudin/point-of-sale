@extends('dashboard')
@section('title', 'History Salary')

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
                                <li class="breadcrumb-item"><a href="#">History Salary</a></li>
                                <li class="breadcrumb-item active">History</li>
                            </ol>
                        </div>
                        <h4 class="page-title"><i class="mdi mdi-bank-outline"></i> History Salary</h4>
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
                                    <div class="col-md-12 text-center">
                                        <div class="mb-3"><img src="{{ asset($historysalary->employee->image) }}"
                                                alt="" class="avatar-lg img-thumbnail" alt="profile-image">
                                            <h4 class="mb-0">{{ $historysalary['employee']['name'] }}</h4>
                                            <h5 class="text-muted">
                                                {{ $historysalary->created_at }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Salary Month</label>
                                            <p><strong style="color: #fc0101;">{{ $historysalary->salary_month }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Paid Amount</label>
                                            <p><strong style="color: #fc0101;">Rp.
                                                    {{ $historysalary->paid_amount }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Advance Salary</label>
                                            <p><strong style="color: #ee0707;">Rp.
                                                    {{ $historysalary->advance_salary }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Due Salary</label>
                                            <p><strong style="color: #f10909;">Rp. {{ $historysalary->due_salary }}</strong>
                                            </p>
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
