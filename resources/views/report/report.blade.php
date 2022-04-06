@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">Report</h1>
    <div class="row gy-5">
        <div class="col-4">
            <form action="{{route('generateDaily')}}" method="post">
                {{ csrf_field() }}
                <button type="submit">Generate Daily Report</button>
            </form>
            <form action="{{route('generateMonthly')}}" method="post">
                {{ csrf_field() }}
                <button type="submit">Generate Monthly Report</button>
            </form>
            <form action="{{route('generateYearly')}}" method="post">
                {{ csrf_field() }}
                <button type="submit">Generate Yearly Report</button>
            </form>
        </div>
    </div>
</div>
@endsection