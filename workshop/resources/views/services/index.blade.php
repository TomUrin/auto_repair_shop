@extends('layouts.app')
@section('title')
Car repair workshops
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Services list</div>
                <div class="card-body">
                    @if (Auth::user()->role > 9)
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                    <div class="d-grid gap-2">
                        <a class="btn btn-outline-success mb-2" href="{{route('services-create')}}">Click here to add new service</a>
                    </div>
                    </div>
                    </div>
                    @endif
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">NAME OF THE SERVICE</th>
                                <th scope="col">REPAIR TIME IN HOURS</th>
                                <th scope="col">PRICE &#8364</th>
                                <th scope="col"></th>
                        </thead>
                        @foreach($services as $service)
                        <tbody>
                            <tr>
                                <td scope="row"> {{$service->service_title}} </td>
                                <td scope="row"> {{$service->duration}} </td>
                                <td scope="row"> {{$service->price}} </td>
                                <td scope="row" class="actions">
                                    <a class="btn btn-outline-info btn-sm me-2 " href="{{route('services-show', $service->id)}}">SHOW</a>
                                    @if (Auth::user()->role > 9)
                                    <a class="btn btn-outline-warning btn-sm me-2 " href="{{route('services-edit', $service)}}">EDIT</a>
                                    <form method="POST" action="{{route('services-delete', $service)}}">
                                        <button class="btn btn-outline-danger btn-sm mt-2" type="submit">DELETE</button>
                                        @endif
                                </td>
                            </tr>
                        </tbody>
                        @csrf
                        @method('delete')
                        </form>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
