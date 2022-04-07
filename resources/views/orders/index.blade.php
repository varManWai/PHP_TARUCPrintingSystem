@extends('layouts.app')
@php
use App\Models\subject;
@endphp
@section('content')
<div class="container">
    <h1 class="mb-5">Subjects</h1>
    <div class="row gy-5">
        @foreach ($subjectIDs as $subjectID)
            @php
                $subject = subject::where('subjectID',$subjectID->subjectID)
                ->get();
            @endphp
            @foreach ($subject as $subjectDesc)
            
            <div class="col-4">
                <form action="{{ route('AddCart') }}" method="POST" > 
                    @csrf      
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $subjectDesc['title'] }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Course: {{ $subjectDesc['courseCode'] }}</h6>
                            <p class="card-text">Pages: {{ $subjectDesc['pages'] }}</p>
                            <p class="card-text">Price: RM {{ $subjectDesc['price'] }}</p>
                            <button type="submit" class="btn btn-primary">Add To Cart</button>
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
        @endforeach
    </div>
</div>
@endsection
