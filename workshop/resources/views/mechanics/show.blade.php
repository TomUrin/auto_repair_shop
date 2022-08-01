@extends('layouts.app')
@section('links')
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/star-rating.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.js"></script>
@endsection
@push('styles')
<link href="{{mix('resources/sass/mechanicCard.scss')}}" rel="stylesheet">
@endpush
@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="d-grid gap-2 col-md-4">
        <a class="btn btn-outline-success mb-2" href="{{route('mechanics-index')}}">Back to the mechanics list</a>
    </div>
    </div>
    <div class="container d-flex justify-content-center mt-5">
        <div class="card text-center mb-5">
            <div class="circle-image">
                <img src="{{$mechanic->image_path}}" width="50">
            </div>
            <span class="name mb-1 fw-500">{{$mechanic->name}} {{$mechanic->surname}}</span>
            <br>
            <h5 class="mb-0">Workplace</h5>
            <small class="text-truncate ml-2">{{$mechanic->workshop->title}}</small>
            <br>
            <div class="rate bg-success py-3 text-white mt-3">
                <h6 class="mb-0">Rating</h6>
                <div class="rating">
                    <input id="input-3" name="input-3" data-size="xs" class="rating rating-loading" data-show-clear="false" data-show-caption="false" value="{{ $mechanic->avrRating }}" readonly>
                </div>
                Average: {{ $mechanic->avrRating }}/5 &#38 Ratings: {{ $mechanic->rate_count }}
            </div>
        </div>
    </div>
    @csrf
    @method('show')
</div>
</div>
</div>
</div>
</div>
<script>
    $(document).ready(function() {
        $('#input-3').rating({
            displayOnly: true
            , step: 0.25
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
