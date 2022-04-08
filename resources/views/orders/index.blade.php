@extends('layouts.app')
@php
use App\Models\subject;
@endphp
@section('content')
<div class="container">
    <h1 class="mb-5">Subjects</h1>
    @if (\Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{!! \Session::get('success') !!}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
    <div class="row gy-5">
        
        @foreach ($subjectIDs as $subjectID)
        @php
        $subject = subject::where('subjectID',$subjectID)
        ->first()
        ->toArray();

        $fileName = substr($subject['image'],23)
        @endphp
        
        <div class="col-4">
            <form action="{{ route('AddCart') }}" method="POST" > 
                @csrf      
                <div class="card" style="width: 18rem;">
                    <div class="" style="max-height: 10rem; max-width:20rem;overflow:hidden;">
                        <img src="{{ asset('storage/image/subjects/'.$fileName ) }}" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $subject['title'] }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Course: {{ $subject['courseCode'] }}</h6>
                        <p class="card-text">Pages: {{ $subject['pages'] }}</p>
                        <p class="card-text">Price: RM {{ $subject['price'] }}</p>
                        <input type="hidden" id="subjectID" name="subjectID" value="{{ $subjectID }}">
                        <button type="submit" class="btn btn-primary">Add To Cart</button>
                    </div>
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection
