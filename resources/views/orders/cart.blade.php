{{-- Author: Nizar Bin Hamid --}}
@extends('layouts.app')
@php
$totalPrice = 0;

$filePath = '../public/xsl/orderDetails.xml';
$dom     = new \DOMDocument('1.0', 'utf-8'); 
$dom->appendChild($dom->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="orderDetails.xsl"'));
$root      = $dom->createElement('orderDetails'); 

@endphp
@section('content')
<div class="container">
    <h1 class="text-center">Cart</h1>
    @isset($success)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ $success }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endisset
    <div class="container h-auto overflow-scroll" style="height: 25%">
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
        @php
            $orderDetail = $dom->createElement('SubjectDetail');

            $subjectName = $dom->createElement('subjectTitle',$subjectDetails[0]->title);
            $orderDetail->appendChild($subjectName);

            $subjectPages = $dom->createElement('subjectPages', $subjectDetails[0]->price);
            $orderDetail->appendChild($subjectPages);

            $subjectQty = $dom->createElement('Qty',$subject->Quantity);
            $orderDetail->appendChild($subjectQty);

            $subjectTotal = $dom->createElement('subjectTotal',$subjectDetails[0]->price*$subject->Quantity);
            $orderDetail->appendChild($subjectTotal);

            $root->appendChild($orderDetail);
        @endphp
        @endforeach
        @php
            $orderTotal = $dom->createElement('TotalPrice',$totalPrice);
            $root->appendChild($orderTotal);
            $dom->appendChild($root);
            $dom->save($filePath);
        @endphp
    </div>
    <div>
        <a href="/proceedPay" class="btn btn-primary">CheckOut</a>
    </div>
</div>
@endsection