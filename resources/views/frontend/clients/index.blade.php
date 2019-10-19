@extends('frontend.layouts.app')

@section('title', 'Batteries Manager')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="card-title mb-0">
                        <small class="text-muted">Clients</small>
                    </h4>
                </div>
                <div class="col-sm-6">
                    <div class="btn-toolbar float-right" role="toolbar">
                        <a href="{{route('frontend.client.createView')}}" class="btn btn-success">
                            <i class="fa fa-plus-circle"></i> Add new Client
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Personal Code</th>
                                <th>Gender</th>
                                <th>Birth Date</th>
                                <th>Edit</th>
                            </tr>
                            @foreach($paginator->items() as $client)
                                <tr>
                                    <td>{{$client->first_name}}</td>
                                    <td>{{$client->last_name}}</td>
                                    <td>{{$client->email}}</td>
                                    <td>{{$client->personal_code}}</td>
                                    <td>{{$client->getGenderText()}}</td>
                                    <td>{{$client->birth_date->format('d-m-Y')}}</td>
                                    <td>
                                        <div class="btn-group-sm">
                                            <a href="{{route('frontend.client.editView', ['id' => $client->id])}}" class="btn btn-success">
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
