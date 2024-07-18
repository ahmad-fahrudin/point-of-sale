@extends('dashboard')
@section('title', 'Edit Advance Salary')

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
                                <li class="breadcrumb-item"><a href="#">Advance Salary</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                        <h4 class="page-title"><i class="mdi mdi-bank-outline"></i> Edit Advance Salary</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-pane">
                                <form method="POST" action="{{ route('advance.salary.update') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $salary->id }}">
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>Advance
                                        Salary
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="experience" class="form-label">Employee Name</label>
                                                <select class="form-select" name="employee_id" id="">
                                                    <option selected disabled>Select Employee</option>
                                                    @foreach ($employee as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == $salary->employee_id ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="month" class="form-label">Salary Month</label>
                                                <select class="form-select" name="month" id="month">
                                                    <option selected disabled>Select Month</option>
                                                    <option
                                                        value="January"{{ $salary->month == 'January' ? 'selected' : '' }}>
                                                        January</option>
                                                    <option
                                                        value="February"{{ $salary->month == 'February' ? 'selected' : '' }}>
                                                        February</option>
                                                    <option value="March"{{ $salary->month == 'March' ? 'selected' : '' }}>
                                                        March</option>
                                                    <option value="April"{{ $salary->month == 'April' ? 'selected' : '' }}>
                                                        April</option>
                                                    <option value="May"{{ $salary->month == 'May' ? 'selected' : '' }}>
                                                        May</option>
                                                    <option value="June"{{ $salary->month == 'June' ? 'selected' : '' }}>
                                                        June</option>
                                                    <option value="July"{{ $salary->month == 'July' ? 'selected' : '' }}>
                                                        July</option>
                                                    <option
                                                        value="August"{{ $salary->month == 'August' ? 'selected' : '' }}>
                                                        August</option>
                                                    <option
                                                        value="September"{{ $salary->month == 'September' ? 'selected' : '' }}>
                                                        September</option>
                                                    <option
                                                        value="November"{{ $salary->month == 'November' ? 'selected' : '' }}>
                                                        November</option>
                                                    <option
                                                        value="October"{{ $salary->month == 'October' ? 'selected' : '' }}>
                                                        October</option>
                                                    <option
                                                        value="December"{{ $salary->month == 'December' ? 'selected' : '' }}>
                                                        December</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="year" class="form-label">Year</label>
                                                <select class="form-select" name="year" id="year">
                                                    <option selected disabled>Select Year</option>
                                                    <option value="2024"{{ $salary->year == '2024' ? 'selected' : '' }}>
                                                        2024</option>
                                                    <option value="2025"{{ $salary->year == '2025' ? 'selected' : '' }}>
                                                        2025</option>
                                                    <option value="2026"{{ $salary->year == '2026' ? 'selected' : '' }}>
                                                        2026</option>
                                                    <option value="2027"{{ $salary->year == '2027' ? 'selected' : '' }}>
                                                        2027</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="advance_salary" class="form-label">Advance Salary</label>
                                                <input type="text" class="form-control" id="advance_salary"
                                                    value="Rp. {{ $salary->advance_salary }}" name="advance_salary">
                                            </div>
                                        </div>

                                    </div> <!-- end row -->
                                    <div class="text-end">
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
@endsection
