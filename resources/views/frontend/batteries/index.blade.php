@extends('frontend.layouts.app')

@section('title', 'Client Manager')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="card-title mb-0">
                        <small class="text-muted">Test Batteries</small>
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
                                <td class="text-center">Default Battery</td>
                                <td>Copy</td>
                                <td>Action</td>
                            </tr>
                            @foreach($paginator->items() as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{implode(", ", $item->getTestNameArr())}}</td>
                                    <td class="text-center">
                                        @if($item->is_default == \App\Models\Battery::BATTERY_DEFAULT)
                                        <span class="badge badge-success">
                                            <i class="fa fa-fw fa-check" ></i>
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <button-copy :copy-text="'{{route('frontend.battery.clientBattery', ['batteryId' => $item->id])}}'" success-text="Battery link success copied to your clip board">
                                            <i class="fa fa-fw fa-copy"></i> Copy Test Link
                                        </button-copy>
                                    </td>
                                    <td>
                                        @if($item->is_default != \App\Models\Battery::BATTERY_DEFAULT)
                                            <div class="btn-group-sm">
                                                <a href="{{route('frontend.battery.editView', ['id' => $item->id])}}" class="btn btn-success">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                            </div>
                                        @endif
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
