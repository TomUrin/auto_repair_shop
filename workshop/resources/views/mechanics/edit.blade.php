@extends('layouts.app')
@section('links')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection
@push('styles')
<link href="{{mix('resources/sass/mechanicCard.scss')}}" rel="stylesheet">
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">Edit mechanic database</div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a class="btn btn-outline-success mb-2" href="{{route('mechanics-index')}}">Back to the mechanics list</a>
                    </div>
                    <form method="post" action="{{route('mechanics-update', $mechanics)}}" enctype="multipart/form-data">
                        <div class="container d-flex justify-content-center mt-5">
                            <div class="card text-center mb-5">
                                <div class="circle-image">
                                    <img src="{{$mechanics->image_path}}" width="50">
                                </div>
                                <span class="name mb-1 fw-500">{{$mechanics->name}} {{$mechanics->surname}}</span>
                                <br>
                                <h5 class="mb-0">Workplace</h5>
                                <small class="text-truncate ml-2">{{$mechanics->workshop->title}}</small>
                                <br>
                                <div class="rate bg-success py-3 text-white mt-3">
                                    <h6 class="mb-0">Rate your mechanic</h6>
                                    <div class="rating"> <input type="radio" name="newRating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="newRating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="newRating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="newRating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="newRating" value="1" id="1"><label for="1">☆</label>
                                    </div>
                                    <div class="buttons px-4 mt-0">
                                        <button class="btn btn-warning btn-block rating-submit">Submit</button>
                                    </div>
                                    <input type="hidden" name="newName" type="text" class="form-control" value="{{$mechanics->name}}">
                                    <input type="hidden" name="newSurname" type="text" class="form-control" value="{{$mechanics->surname}}">
                                    <input type="hidden" name="newWorkshop" type="text" class="form-control" value="{{$mechanics->workshop_id}}">
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->role > 9)
                        <div class="form-group mt-4">
                            <label>Name</label>
                            <input name="newName" type="text" class="form-control" value="{{$mechanics->name}}">
                            <div class="form-group mt-4">
                                <label>Surname</label>
                                <input name="newSurname" type="text" class="form-control" value="{{$mechanics->surname}}">
                            </div>
                            <div class="form-group mt-4">
                                <label>Photo</label>
                                <div>
                                    <img class="photo-box" src="{{ $mechanics->image_path }}" />
                                    <input name="mechanic_photo" type="file" class="form-control">
                                </div>
                            </div>
                            <div class="form-group-md mt-4">
                                <label>Workshop</label>
                                <div>
                                    <select name="newWorkshop" class="form-select" id="inputGroupSelect01">
                                        @foreach($workshops as $workshop)
                                        <option value="{{$workshop->id}}">{{$workshop->title}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mx-auto mt-4">
                                <button type="submit" name="submit" value="send" class="btn btn-outline-success btn-sm">EDIT</button>
                            </div>
                            @endif
                            @if (Auth::user()->role > 9)
                            <div class="rating">
                                <label>Rating</label>
                                <input id="input-7" name="newRating" data-size="xs" class="rating rating-loading" data-show-clear="false" data-show-caption="false">
                            </div>
                            <div class="mx-auto">
                                <button type="submit" class="btn btn-outline-success btn-sm">RATE</button>
                            </div>
                @endif
                @csrf
                @method('put')
                </form>
                @if (Auth::user()->role < 9) @if($mechanics->image_path)
                    <form method="post" action="{{route('mechanics-delete-picture', $mechanics)}}" enctype="multipart/form-data">
                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete photo</button>
                        @csrf
                        @method('put')
                    </form>
                    @endif
                    @endif
                    <script>
                        $(document).ready(function() {
                            $('#input-3').rating({
                                displayOnly: true
                                , step: 0.5
                            });
                            $('#input-5').rating({
                                clearCaption: 'No stars yet'
                            });
                            $('#input-8').rating({
                                rtl: true
                                , containerClass: 'is-star'
                            });
                            $('#input-9').rating();
                        });

                    </script>
                    @endsection
