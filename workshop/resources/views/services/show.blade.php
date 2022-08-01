@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Service</div>

                <div class="card-body">
                <div class="d-grid gap-2">
                    <a class="btn btn-outline-success mb-2" href="{{route('services-index')}}">Back to the services list</a>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">NAME OF THE SERVICE</th>
                                <th scope="col">REPAIR TIME IN HOURS</th>
                                <th scope="col">PRICE</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <td scope="row"> {{$service->service_title}} </td>
                                <td scope="row"> {{$service->duration}} </td>
                                <td scope="row"> {{$service->price}} </td>
                            </tr>
                        </tbody>
                        @csrf
                        @method('show')
                        </form>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection