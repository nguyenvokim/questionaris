@extends('frontend.layouts.app')

@section('title', 'Client Manager')

@section('content')
    <form class="form-horizontal" method="post" action="{{route('frontend.client.create')}}">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="card-title mb-0">
                            Create new client
                            <small class="text-muted"></small>
                        </h4>
                    </div>
                </div>
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-md-2 form-control-lable">Title</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{old('title')}}" name="title" id="title" placeholder="Title" maxlength="191" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 form-control-lable">First Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{old('first_name')}}" name="first_name" id="first_name" placeholder="First Name" maxlength="25" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 form-control-lable">Last Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{old('last_name')}}" name="last_name" id="last_name" placeholder="Last Name" maxlength="25" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 form-control-lable">Email</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{old('email')}}" name="email" id="email" placeholder="Email" maxlength="191" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 form-control-lable">Personal Code</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{old('personal_code')}}" name="personal_code" id="personal_code" placeholder="Personal Code" maxlength="191" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 form-control-lable">Birth date</label>
                            <div class="col-md-10">
                                <custom-datepicker
                                        init-value="{{old('birth_date')}}"
                                        format="dd-MM-yyyy"
                                        name="birth_date"
                                        placeholder="Select birth date"
                                        :input-class="'form-control'">
                                </custom-datepicker>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 form-control-lable">Gender</label>
                            <div class="col-md-10">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="0">Male</option>
                                    <option value="1" @if(old('gender') == 1)selected="selected"@endif>Female</option>
                                    <option value="2" @if(old('gender') == 2)selected="selected"@endif>Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <a href="{{route('frontend.client.index')}}" class="btn btn-danger btn-sm">
                            <i class="fa fa-backward"></i> Back
                        </a>
                    </div>
                    <div class="col text-right">
                        <input type="submit" value="Create" class="btn btn-success btn-sm" />
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
