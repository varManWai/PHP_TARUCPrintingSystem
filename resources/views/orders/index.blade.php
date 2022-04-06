@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">Subjects</h1>
    <div class="row gy-5">
        @foreach ($subjects as $subject)
        <div class="col-4">
            <form action="{{ route('AddCart') }}" method="POST" > 
                @csrf      
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $subject['title'] }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Course: {{ $subject['courseCode'] }}</h6>
                        <p class="card-text">Pages: {{ $subject['pages'] }}</p>
                        <p class="card-text">Price: RM {{ $subject['price'] }}</p>
                        <button type="submit" class="btn btn-primary">Add To Cart</button>
                    </div>
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection
