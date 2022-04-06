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
            @if ($type==0)
                <p>daily</p>
            @endif

            @if ($type==1)
                <p>Monthly</p>
            @endif

            @if ($type==2)
                <p>Yearly</p>
            @endif
        </div>
    </div>
</div>
@endsection