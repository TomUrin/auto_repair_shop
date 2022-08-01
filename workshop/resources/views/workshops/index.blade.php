@extends('layouts.app')

@section('title')
Car repair workshops
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            {{-- @include('front.box') --}}
            <div class="card">
                <div class="card-header">Workshops list</div>
                <div class="card-body">
                    @if (Auth::user()->role > 9)
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="d-grid gap-2">
                                <a class="btn btn-outline-success mb-2" href="{{route('workshops-create')}}">Click here to add new workshop</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">TITLE</th>
                                <th scope="col">ADDRESS</th>
                                <th scope="col">CONTACTS</th>
                                <th scope="col"></th>
                        </thead>
                        @foreach($workshops as $workshop)
                        <tbody>
                            <tr>
                                <td scope="row"> {{$workshop->title}} </td>
                                <td scope="row"> {{$workshop->address}} </td>
                                <td scope="row"> {{$workshop->contacts}} </td>
                                <td scope="row" class="actions">
                                    <a class="btn btn-outline-info btn-sm me-2 " href="{{route('workshops-show', $workshop->id)}}">SHOW</a>
                                    @if (Auth::user()->role > 9)
                                    <a class="btn btn-outline-warning btn-sm me-2 " href="{{route('workshops-edit', $workshop)}}">EDIT</a>
                                    <form method="POST" action="{{route('workshops-delete', $workshop)}}">
                                        <button class="btn btn-outline-danger btn-sm mt-2" type="submit">DELETE</button>
                                </td>
                                @endif
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
