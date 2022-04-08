{{-- Author:Lai Man Wai --}}



@extends('layouts.supplier')

@section('content')
    <main>
        <div id="app">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 ">
                        <div class="card mt-5">
                            <div class="card-header ">Update Account Information</div>

                            <div class="card-body">

                                @if (session('updated'))
                                    <div class="alert alert-success">
                                        {{ session('updated') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('editedOrderStatus') }}">
                                    @csrf
                                    <div class="row mb-5 mt-3">
                                        <label for="name"
                                            class="col-md-3 col-form-label text-md-end">{{ __('Name') }}</label>



                                        <div class="col-md-3">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name2"
                                                value="{{ $order->status }}" autocomplete="name" autofocus
                                                placeholder="Micheal Jackson" disabled>
                                        </div>

                                        <div class="col-md-3">
                                            <select id="status" name="status" class="form-select" aria-label="Default select example">
                                                <option selected>Open this select Status</option>
                                                <option value="Delivering">Delivering</option>
                                                <option value="Completed">Completed</option>
                                            </select>
                                        </div>

                                        <input type="hidden" name="orderID" value="{{ $order->orderID }}" />

                                        <div class="col-md-1 ">
                                            <button type="submit" class="btn btn-dark">
                                                {{ __('Update') }}
                                            </button>
                                        </div>

                                    </div>
                                </form>

                                <hr style="color: transparent" />


                                <div class="d-flex justify-content-center my-5">
                                    <div class="col-md-1">
                                        <a href="{{ route('orderStatusDashboard') }}" class="btn btn-dark ">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
