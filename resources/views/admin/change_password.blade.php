@extends('dashboard')
@section('title', 'Change Password')

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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                <li class="breadcrumb-item active">Change Password</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Change Password</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-10 col-xl-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-pane">
                                <form method="POST" action="{{ route('update.password') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Old Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password"
                                                        class="form-control @error('old_password') is-invalid @enderror"
                                                        id="current_password" name="old_password"
                                                        placeholder="Enter your Old password">
                                                    <div class="input-group-text" data-password="false">
                                                        <span class="password-eye"></span>
                                                    </div>
                                                </div>
                                                @error('old_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="new_password" class="form-label">New Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password"
                                                        class="form-control @error('new_password') is-invalid @enderror"
                                                        id="new_password" name="new_password"
                                                        placeholder="Enter your New Password">
                                                    <div class="input-group-text" data-password="false">
                                                        <span class="password-eye"></span>
                                                    </div>
                                                </div>
                                                @error('new_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="new_password_confirmation" class="form-label">Confirm New
                                                    Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" class="form-control"
                                                        id="new_password_confirmation" name="new_password_confirmation"
                                                        placeholder="Enter your Confirmation Password">
                                                    <div class="input-group-text" data-password="false">
                                                        <span class="password-eye"></span>
                                                    </div>
                                                </div>
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
