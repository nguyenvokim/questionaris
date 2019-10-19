@extends('frontend.layouts.app')

@section('title', 'Client Manager')

@section('content')
    <form class="form-horizontal" method="post" action="{{route('frontend.battery.create')}}">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="card-title mb-0">
                            Create new battery
                            <small class="text-muted"></small>
                        </h4>
                    </div>
                </div>
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-md-2 form-control-lable">Battery Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{old('name')}}" name="name" id="name" placeholder="Battery Name" maxlength="191" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 form-control-lable">Tests</label>
                            <div class="col-md-10">
                                <custom-select-list input-name="test_ids" v-bind:list='{{$testJson}}'></custom-select-list>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <a href="{{route('frontend.battery.index')}}" class="btn btn-danger btn-sm">
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
