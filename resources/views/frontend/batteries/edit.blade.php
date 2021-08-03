@extends('frontend.layouts.app')

@section('title', 'Client Manager')

@section('content')
    <form class="form-horizontal" method="post" action="{{route('frontend.battery.edit', ['id' => $battery->id])}}">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="card-title mb-0">
                            Edit battery
                            <small class="text-muted"></small>
                            <div class="float-right">
                                <delete-battery
                                        :reload-after-delete="false"
                                        redirect-link="{{route('frontend.battery.index')}}"
                                        :id="{{ $battery->id }}">

                                </delete-battery>
                            </div>
                        </h4>
                    </div>
                </div>
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-md-2 form-control-lable">Battery Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$battery->name}}" name="name" id="name" placeholder="Battery Name" maxlength="30" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 form-control-lable">Tests</label>
                            <div class="col-md-10">
                                <custom-select-list :init-select='{{$testIdsJson}}' input-name="test_ids" v-bind:list='{{$testJson}}'></custom-select-list>
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
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fal-fw fa-save"></i> Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
