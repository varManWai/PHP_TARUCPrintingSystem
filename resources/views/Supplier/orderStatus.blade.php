@extends('layouts.supplier')

@section('content')
    <main>
        <div id="app">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 ">
                        <div class="card mt-3">

                            @if (session('delete'))
                                <div class="alert alert-danger">
                                    {{ session('delete') }}
                                </div>
                            @endif

                            <div class="card-header ">Supplier Account Management</div>

                            <div class="card-body table-responsive-xl">
                                @if (count($orders) == 0)
                                    <h2>Nothing here</h2>
                                @else
                                    <table class="table  table-hover">
                                        <thead>
                                            <tr class="">
                                                <th scope="col" class="">No</th>
                                                <th scope="col" class="">ID</th>
                                                <th scope="col" class="">Amount</th>
                                                <th scope="col" class="">Date</th>
                                                <th scope="col" class="">Status</th>
                                                <th scope="col" class="">Delivery method</th>
                                                <th scope="col" class="">User</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($orders as $order)
                                                <tr class="">
                                                    <td class="">
                                                        {{ $i }}
                                                    </td>
                                                    <td class="">
                                                        {{ $order->orderID }}
                                                    </td>
                                                    <td class="">
                                                        {{ $order->totalPrice }}
                                                    </td>
                                                    <td class="">
                                                        {{ $order->date }}
                                                    </td>
                                                    <td class="">
                                                        {{ $order->status }}
                                                    </td>
                                                    <td class="">
                                                        {{ $order->pickUpMethod }}
                                                    </td>
                                                    <td class="">
                                                        {{ $order->username}}
                                                    </td>
                                                    <td class="">
                                                        <a href="{{ route('editOrderStatus', ['id' => $order->orderID]) }}"
                                                            class="btn btn-dark">Edit Status</a>
                                                    </td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
