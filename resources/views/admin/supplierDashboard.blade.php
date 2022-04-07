@extends('layouts.admin')

@section('content')
    <main>
        <div id="app">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 ">
                        <div class="card mt-3">
                            <a href="{{ route('addSupplierAccount') }}" class="btn btn-dark"> Add New User</a>
                        </div>
                        <div class="card mt-3">



                            <div class="card-header ">Suppliers Account Management</div>

                            <div class="card-body table-responsive-xl">
                                @if (count($users) == 0)
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
                                            @foreach ($users as $user)
                                                <tr class="">
                                                    <td class="">
                                                        {{ $i }}
                                                    </td>
                                                    <td class="">
                                                        {{ $user->name }}
                                                    </td>
                                                    <td class="">
                                                        {{ $user->email }}
                                                    </td>
                                                    <td class="">
                                                        {{ $user->phoneNo }}
                                                    </td>
                                                    <td class="">
                                                        {{ $user->created_at }}
                                                    </td>
                                                    <td class="">
                                                        {{ $user->shopName }}
                                                    </td>
                                                    <td class="">
                                                        {{ $user->location }}
                                                    </td>
                                                    <td class="">
                                                        <a href="\editSupplierAccount\{{$user->id}}" class="btn btn-primary">Edit</a>
                                                    </td>
                                                    <td class="">
                                                        <a href="\deleteSupplierAccoun\{{$user->id}}" class="btn btn-danger">Delete</a>
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
