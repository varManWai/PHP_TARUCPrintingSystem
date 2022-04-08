{{-- Author: Nizar Bin Hamid, Chan Owen --}}
@extends('layouts.app')

@section('content')
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
            <a href="{{ route('Cart') }}" class="btn btn-primary"> <strong>Cancel</strong> </a>
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
@endsection