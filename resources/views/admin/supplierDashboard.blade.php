{{-- Author:Lai Man Wai --}}

@extends('layouts.admin')

@section('content')
    <main>
        <div id="app">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 ">
                        <div class="card mt-3">
                            <a href="{{ route('addSupplierAccount') }}" class="btn btn-primary">Add New Supplier</a>
                        </div>
                        <div class="card mt-3">

                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if (session('delete'))
                                <div class="alert alert-danger">
                                    {{ session('delete') }}
                                </div>
                            @endif

                            <div class="card-header ">Suppliers Account Management</div>

                            <div class="card-body table-responsive-xl">
                                @if (count($suppliers) == 0)
                                    <h2>Nothing here</h2>
                                @else
                                    <table class="table  table-hover">
                                        <thead>
                                            <tr class="">
                                                <th scope="col" class="">No</th>
                                                <th scope="col" class="">Name</th>
                                                <th scope="col" class="">Email</th>
                                                <th scope="col" class="">Phone No.</th>
                                                <th scope="col" class="">Shop Name</th>
                                                <th scope="col" class="">Location</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($suppliers as $supplier)
                                                <tr class="">
                                                    <td class="">
                                                        {{ $i }}
                                                    </td>
                                                    <td class="">
                                                        {{ $supplier->name }}
                                                    </td>
                                                    <td class="">
                                                        {{ $supplier->email }}
                                                    </td>
                                                    <td class="">
                                                        {{ $supplier->phoneNo }}
                                                    </td>
                                                    <td class="">
                                                        {{ $supplier->shopName }}
                                                    </td>
                                                    <td class="">
                                                        {{ $supplier->location }}
                                                    </td>
                                                    <td class="">
                                                        <a href="{{ route('editSupplierAccount', ['id' => $supplier->id]) }}"
                                                            class="btn btn-primary">Edit</a>
                                                    </td>
                                                    <td class="">
                                                        <a href="{{ route('deleteSupplierAccount', ['id' => $supplier->id]) }}"
                                                            class="btn btn-danger">Delete</a>
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
