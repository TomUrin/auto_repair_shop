@extends('layouts.app')
@section('links')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />

<!-- with v4.1.0 Krajee SVG theme is used as default (and must be loaded as below) - include any of the other theme CSS files as mentioned below (and change the theme property of the plugin) -->
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />


<!-- with v4.1.0 Krajee SVG theme is used as default (and must be loaded as below) - include any of the other theme JS files as mentioned below (and change the theme property of the plugin) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">


<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/star-rating.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Add new mechanic</div>
                <div class="card-body">

                    <form class="create" action="{{route('selectedServices-add')}}" method="post" type="submit" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="createServices">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Choose workshop</label>
                                <div>
                                    <select name="workshop_id" class="form-select-lg">
                                        @foreach($workshops as $workshop)
                                        <option value="{{$workshop->id}}">{{$workshop->title}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="color: crimson;">{{ $errors->first('workshop') }}</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Choose mechanic</label>
                                <div>
                                    <select name="mechanic_id" class="form-select-lg">
                                        @foreach($mechanics as $mechanic)
                                        @if($workshop->id == $mechanic->workshop_id)
                                        <option value="{{$mechanic->id}}">
                                            {{$mechanic->name}}
                                            {{$mechanic->surname}}
                                            {{$mechanic->avrRating}}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div style="color: crimson;">{{ $errors->first('workshop') }}</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Choose service</label>
                                <div>
                                    <select name="service_id" class="form-select-lg">
                                        @foreach($services as $service)
                                        <option value="{{$service->id}}">
                                            {{$service->service_title}}
                                            {{$service->price}} &#8364

                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="color: crimson;">{{ $errors->first('workshop') }}</div>

                            </div>
                        </div>
                        <div class="datePicker col-sm-4">
                            <label>Choose date</label>
                            <input class="date form-control" type="numeric" name="date">
                        </div>
                        <div class="mx-auto">
                            <button type="submit" name="submit" value="send" class="btn btn-outline-success mt-5 btn-lg">ADD</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
<script type="text/javascript">
    $('.date').datepicker({
        format: 'dd-mm-yyyy'
    });

</script>
@endsection
@endsection
