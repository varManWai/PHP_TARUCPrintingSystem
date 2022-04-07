@extends('layouts.app')
@php
   $totalPrice;

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
        @endphp
        <div class="card mb-4">
            <div class="card-header ">
                <strong>{{ $subjectDetails[0]->courseCode }}</strong>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $subjectDetails[0]->title }}</h5>
                <p class="card-text">Pages: {{ $subjectDetails[0]->pages }}</p>
                <div>
                    <p class="card-text">Price: RM{{ $subjectDetails[0]->price }} <span class="text-end">Subtotal: RM{{ $subjectDetails[0]->price*$subject->Quantity}}</span></p>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <form action="" method=""> 
                        <a href="#" class="btn btn-primary">+</a>
                        <a href="#" class="btn btn-primary">Remove <span class="badge bg-secondary">{{ $subject->Quantity }}</span></a>
                        <a href="#" class="btn btn-primary">-</a>
                    </form>
                </div>
            </div>
        </div>

        @endforeach
    </div>
    
</div>
@endsection