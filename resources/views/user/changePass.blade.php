@extends('layouts.user')
@section('user')
    <div class="row">
        <div class="col-xl-6 offset-3">
            <div class="card">
                <div class="card-body">
                   <form class="needs-validation" novalidate="" action="{{route('user.change.password.save')}}" method="post">
                       @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom01">New Password</label>
                                    <input type="password" class="form-control" name="npass">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom01">Confirm Password</label>
                                    <input type="password" class="form-control" name="cpass">
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->


    </div>
@endsection
