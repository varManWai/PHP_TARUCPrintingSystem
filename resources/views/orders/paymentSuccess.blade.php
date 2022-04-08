{{-- Author: Nizar Bin Hamid --}}
@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1>Payment Success!</h1>
        <p>You will be redirected to Order History in 3 seconds</p>
    </div>
    <script>
        var timer = setTimeout(function() {
            window.location='/orderHistory'
        }, 3000);
    </script>
@endsection