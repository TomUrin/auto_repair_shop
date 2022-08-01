@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Edit services</div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a class="btn btn-outline-success mb-2" href="{{route('services-index')}}">Back to the services list</a>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">NAME OF THE SERVICE</th>
                                <th scope="col">REPAIR TIME IN HOURS</th>
                                <th scope="col">PRICE &#8364</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <form method="post" action="{{route('services-update', $services)}}">
                            <tbody>
                                <tr>
                                    <td scope="row">
                                        <div class="input-group input-group-sm mb-3">
                                            <input name="newTitle" type="text" class="form-control" value="{{$services->service_title}}">
                                        </div>
                                    </td>
                                    <td scope="row">
                                        <div class="input-group input-group-sm mb-3 col-2">
                                            <input name="newDuration" type="text" class="form-control" value="{{$services->duration}}">

                                        </div>
                                    </td>
                                    <td scope="row">
                                        <div class="input-group input-group-sm mb-3">
                                            <input name="newPrice" type="text" class="form-control" value="{{$services->price}}">
                                        </div>
                                    </td>
                
                                    <td>
                                        <div class="mx-auto">
                                            <button type="submit" name="submit" value="send" class="btn btn-outline-success btn-sm">EDIT</button>
                                        </div>
                                    </td>


                                </tr>

                            </tbody>

                            @csrf
                            @method('put')
                        </form>
                    </table>
                    @endsection
