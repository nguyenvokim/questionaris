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
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Included Tests</th>
                    <th class="text-center">Default Battery</th>
                    <th>Copy Link</th>
                    <th>Edit</th>
                </tr>
                </thead>
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
                            <button-copy :copy-text="'{{route('frontend.battery.clientBattery', ['batteryId' => $item->id])}}'" success-text="Link successfully copied to clipboard">
                                <i class="fa fa-fw fa-copy"></i> Copy Test Link
                            </button-copy>
                        </td>
                        <td>
                            <div class="btn-group-sm">
                                @if($item->is_default != \App\Models\Battery::BATTERY_DEFAULT)
                                    <a href="{{route('frontend.battery.editView', ['id' => $item->id])}}" class="btn btn-success">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <delete-battery :id="{{ $item->id }}"></delete-battery>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="card-footer">
            {{$paginator->render()}}
        </div>
    </div>
@endsection
