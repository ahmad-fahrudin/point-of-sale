@extends('dashboard')
@section('title', 'Employee Attendace')

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
                                <li class="breadcrumb-item"><a href="{{ route('add.employee.attend') }}"
                                        class="btn btn-primary rounded-pill waves-effect waves-light"><i
                                            class="mdi mdi-book-edit-outline"></i> Add Attendence</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><i class="mdi mdi-book-multiple-outline"></i> All Employee Attendence</h4>
                    </div>
                </div>
            </div>
            <br>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Date</th>
                                        <th>action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($allData as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ date('Y-m-d', strtotime($item->date)) }}</td>
                                            <td>
                                                <a href="{{ route('employee.attend.details', $item->date) }}"
                                                    class="btn btn-sm btn-danger waves-effect waves-light"><i
                                                        class="fas fa-eye"></i> View</a>
                                                <a href="{{ route('employee.attend.edit', $item->date) }}"
                                                    class="btn btn-sm btn-blue waves-effect waves-light"><i
                                                        class="fas fa-pencil-alt"></i> Edit</a>
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
