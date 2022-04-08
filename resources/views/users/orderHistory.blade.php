{{-- Author:ChanOwen --}}
@extends('layouts.app')

@section('content')
<div class="container">
    @if ($auth==0)
    <div class="row mt-4 justify-content-center">
        <div class="col"></div>
        <div class="col-8 text-center">
            <img src="{{url('/image/Restrict.png')}}" alt="">
            <h1 style="color: red" class="text-center mt-3"><b>WARNING!!!</b></h1>
            <h2 style="color: red" class="text-center"><b>PLEASE LOG IN FIRST</b></h2>
        </div>
        <div class="col"></div>
    </div>
    @else
    
    
    <h1 class="text-center mb-4"><b>Order History</b></h1>
    @if ($record == 0)
    <div class="row mt-4 justify-content-center">
        <div class="col"></div>
        <div class="col-8 text-center">
            <img src="{{url('/image/empty.png')}}" alt="">
            <h1 style="color: red" class="text-center mt-3"><b>Nothing to show</b></h1>
            <h2 style="color: red" class="text-center">Please place an order first.</h2>
        </div>
        <div class="col"></div>
    </div>
    @else
    
    <div class="accordion mt-4">
        @php
        $i=1;
        @endphp
        @foreach ($data as $item)
        
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{$item->orderID}}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$item->orderID}}" aria-expanded="false" aria-controls="collapse{{$item->orderID}}">
                    Order {{$i}}
                </button>
            </h2>
            <div id="collapse{{$item->orderID}}" class="accordion-collapse collapse" aria-labelledby="heading{{$item->orderID}}" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table class="table table-success table-striped">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Order ID</th>
                                <th scope="col" class="text-center">Date</th>
                                <th scope="col" class="text-center">Total Price</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Pick Up Method</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="text-center">{{$item->orderID}}</th>
                                <td class="text-center">{{$item->date}}</td>
                                <td class="text-center">RM{{$item->totalPrice}}</td>
                                <td class="text-center">{{$item->status}}</td>
                                <td class="text-center">{{$item->pickUpMethod}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @php
        $i++;
        @endphp
        @endforeach
    </div>
    <div class="text-center mt-3">
        <a href="/xmlOrderHistory" target="_blank" class="btn btn-secondary" role="button">Generate as XML to Print</a>
    </div>
    @endif
    @endif
</div>
@endsection