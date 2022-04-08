@extends('layouts.app')
@php
$totalPrice = 0;

@endphp
@section('content')
<div class="container">
    <h1 class="text-center">Cart</h1>
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
        @endforeach
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <h5 class="pb-2 pt-3"><strong> Total Price: RM{{ $totalPrice }}</strong></h5>
                <form action="{{ route('createOrder') }}" method="POST" id="checkOut">
                    @csrf
                    <h5>Pick Up Method</h5>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="pickupMethod" id="pickupMethod">
                        <option selected value="Delivery">Delivery</option>
                        <option value="Walk-In">Walk-In</option>
                    </select>
                    <input type="hidden" id="totalPrice" name="totalPrice" value="{{ $totalPrice }}">
                </form>
            </div>
            <div class="col-6"></div>
            <div class="col">
                <h5 class="mt-3"><strong>Pay With:</strong></h5>
                <!-- Replace "test" with your own sandbox Business account app client ID -->
                <script src="https://www.paypal.com/sdk/js?client-id=AdJzXoQqSrfIENkvfxEzR7q1BaFUrf7xlGIdh37qv0WLfRABuqj6xmH548lTyXJP-kZiMmiOUeNqtP6q&currency=MYR"></script>
                <!-- Set up a container element for the button -->
                <div class="mt-2" id="paypal-button-container"></div>
            </div>
        </div> 
        
        
        <script>
            paypal.Buttons({
                // Sets up the transaction when a payment button is clicked
                createOrder: (data, actions) => {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: {{ $totalPrice }} // Can also reference a variable or function
                            }
                        }]
                    });
                },
                // Finalize the transaction after payer approval
                onApprove: (data, actions) => {
                    return actions.order.capture().then(function(orderData) {
                        // Successful capture! For dev/demo purposes:
                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                        const transaction = orderData.purchase_units[0].payments.captures[0];
                        // alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                        const form = document.getElementById('checkOut');
                        form.submit();
                        // When ready to go live, remove the alert and show a success message within this page. For example:
                        // const element = document.getElementById('paypal-button-container');
                        // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                        // Or go to another URL:  actions.redirect('thank_you.html');
                    });
                }
            }).render('#paypal-button-container');
        </script>
    </div>
</div>
@endsection