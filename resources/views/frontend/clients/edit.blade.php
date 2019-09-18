@extends('frontend.layouts.app')

@section('title', 'Client Manager')

@section('content')
    <form class="form-horizontal" method="post" action="{{route('frontend.client.edit', ['id' => $client->id])}}">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="card-title mb-0">
                            Client Management
                            <small class="text-muted">Edit Client #{{$client->id}}</small>
                        </h4>
                    </div>
                </div>
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-md-2 form-control-lable">Title</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$client->title}}" name="title" id="title" placeholder="Title" maxlength="191" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 form-control-lable">First Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$client->first_name}}" name="first_name" id="first_name" placeholder="First Name" maxlength="191" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 form-control-lable">Last Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$client->last_name}}" name="last_name" id="last_name" placeholder="Last Name" maxlength="191" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 form-control-lable">Email</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$client->email}}" name="email" id="email" placeholder="Email" maxlength="191" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 form-control-lable">Personal Code</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$client->personal_code}}" name="personal_code" id="personal_code" placeholder="Personal Code" maxlength="191" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 form-control-lable">Birth date</label>
                            <div class="col-md-10">
                                <datepicker value="{{$client->birth_date}}" format="yyyy-MM-dd" name="birth_date" placeholder="Select birth date" :input-class="'form-control'"></datepicker>
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
                        <input type="submit" value="Update" class="btn btn-success btn-sm" />
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
