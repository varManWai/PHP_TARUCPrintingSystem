@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">Report</h1>
    <div class="row gy-5">
        <div class="col-4">
            @foreach ($order as $item)
                <p>{{$item->totalPrice}} {{$item->date}}</p> 

            @endforeach
            <p>{{$date}}</p>
        </div>
    </div>
</div>
@endsection