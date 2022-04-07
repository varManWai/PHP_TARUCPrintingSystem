@extends('layouts.app')
@php
$totalPrice = 0;

@endphp
@section('content')
<div class="container">
    <h1 class="text-center">Cart</h1>
    <div class="container vh-100 overflow-scroll">
        @foreach ($subjectID as $subject)
        @php
        $subjectDetails = DB::table('subject')
        ->where('subjectID', '=', $subject->subjectID)
        ->get()
        ->toArray();
        $totalPrice = $totalPrice + ($subjectDetails[0]->price*$subject->Quantity);
        @endphp
        <div class="card mb-4">
            <div class="card-header ">
                <strong>{{ $subjectDetails[0]->courseCode }}</strong>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $subjectDetails[0]->title }}</h5>
                <p class="card-text">Pages: {{ $subjectDetails[0]->pages }}</p>
                <p class="card-text">Price: RM{{ $subjectDetails[0]->price }} </p>
                <p class="card-text">Subtotal: RM{{ $subjectDetails[0]->price*$subject->Quantity}}</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <form action="{{ route('addCartFromCart') }}" method="POST">
                        @csrf
                        <input type="hidden" id="subjectID" name="subjectID" value="{{ $subject->subjectID }}">
                        <button class="btn btn-primary">+</button>
                    </form>
                    <form action="{{ route('removeCart') }}" method="POST">
                        @csrf
                        <input type="hidden" id="subjectID" name="subjectID" value="{{ $subject->subjectID }}">    
                        <button class="btn btn-primary">Remove <span class="badge bg-secondary">{{ $subject->Quantity }}</span></button>
                    </form>
                    <form action="{{ route('reduceCart') }}" method="POST">
                        @csrf
                        <input type="hidden" id="subjectID" name="subjectID" value="{{ $subject->subjectID }}">
                        <button class="btn btn-primary">-</button>
                    </form>
                </div>
            </div>
        </div>
        
        @endforeach
    </div>
    
</div>
@endsection