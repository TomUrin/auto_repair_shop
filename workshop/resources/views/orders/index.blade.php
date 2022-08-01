@extends('layouts.app')
@section('links')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection
@section('content')
<div class="container">
    <div class="d-flex justify-content-center row">
        <div class="col-md-12">
            <div class="rounded">
                <div class="card-header">My Orders</div>
                <div class="table-responsive table-borderless">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Workshop</th>
                                <th scope="col">Mechanic</th>
                                <th scope="col">Service</th>
                                <th scope="col">Price &#8364</th>
                                <th scope="col">Date &#38 time</th>
                                <th scope="col">Status</th>
                                <th scope="col">Rate mechanic</th>
                            </tr>
                        </thead>
                        
                        @foreach($orders as $order)
                        <tbody class="table-body">
                            <tr class="cell-1">
                                <td scope="row"> {{$order->workshop->title}} </td>
                                <td scope="row"> {{$order->mechanic->name}} {{$order->mechanic->surname}} </td>
                                <td scope="row"> {{$order->service->service_title}} </td>
                                <td scope="row"> {{$order->service->price}} </td>
                                <td scope="row"> {{$order->date}}</td>
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
                                
                                <td scope="row">
                                
                                <a class="btn btn-outline-info btn-sm me-2" href="{{route('mechanics-edit', $order->mechanic)}}">RATE</a>
                                
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
