@extends('layouts.app')
@section('links')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Orders</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Client name</th>
                                <th scope="col">Workshop</th>
                                <th scope="col">Mechanic</th>
                                <th scope="col">Service</th>
                                <th scope="col">Date &#38 time</th>
                                <th scope="col">Status</th>
                                <th scope="col">Change status</th>
                            </tr>
                        </thead>
                        @foreach($orders as $order)
                        <tbody>
                            <tr>
                                <td scope="row"> {{$order->client->name}} </td>
                                <td scope="row"> {{$order->workshop->title}} </td>
                                <td scope="row"> {{$order->mechanic->name}} {{$order->mechanic->surname}} </td>
                                <td scope="row"> {{$order->service->service_title}} </td>
                                <td scope="row"> {{$order->service->date}}</td>
                                <td scope="row">
                                    @if($order->status == 1)
                                    <span class="badge rounded-pill bg-warning">{{$statuses[$order->status]}}</span>
                                    @endif
                                    @if($order->status == 2)
                                    <span class="badge rounded-pill bg-success">{{$statuses[$order->status]}}</span>
                                    @endif
                                    @if($order->status == 3)
                                    <span class="badge rounded-pill bg-danger">{{$statuses[$order->status]}}</span>
                                    @endif
                                </td>
                                <td scope="row" class="status">
                                    <form class="delete form statusForm" action="{{route('selectedServices-status', $order)}}" method="post">
                                        @csrf
                                        @method('put')
                                        <select class="form-select form-select-sm" name="status">
                                            @foreach($statuses as $key => $status)
                                            <option value="{{$key}}" @if($key==$order->status) selected @endif>{{$status}}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm ms-3 mt-2">Set status</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
