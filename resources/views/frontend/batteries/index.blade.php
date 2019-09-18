@extends('frontend.layouts.app')

@section('title', 'Client Manager')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="card-title mb-0">
                        <small class="text-muted">List Batteries</small>
                    </h4>
                </div>
                <div class="col-sm-6">
                    <div class="btn-toolbar float-right" role="toolbar">
                        <a href="{{route('frontend.battery.createView')}}" class="btn btn-success">
                            <i class="fa fa-plus-circle"></i> Add new Battery
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Name</td>
                                <td>Test Including</td>
                                <td>Action</td>
                            </tr>
                            @foreach($paginator->items() as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{implode(", ", $item->getTestNameArr())}}</td>
                                    <td>
                                        <div class="btn-group-sm">
                                            <a href="{{route('frontend.battery.editView', ['id' => $item->id])}}" class="btn btn-success">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            {{$paginator->render()}}
        </div>
    </div>
@endsection
