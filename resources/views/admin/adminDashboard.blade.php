@extends('layouts.admin')

@section('content')
    <main>
        <div id="app">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 ">
                        <div class="card mt-3">
                            <a href="{{ route('addAdminAccount') }}" class="btn btn-primary">Add New Admin</a>
                        </div>
                        <div class="card mt-3">

                            @if (session('delete'))
                                <div class="alert alert-danger">
                                    {{ session('delete') }}
                                </div>
                            @endif

                            <div class="card-header ">Admin Account Management</div>

                            <div class="card-body table-responsive-xl">
                                @if (count($admins) == 0)
                                    <h2>Nothing here</h2>
                                @else
                                    <table class="table  table-hover">
                                        <thead>
                                            <tr class="">
                                                <th scope="col" class="">No</th>
                                                <th scope="col" class="">Name</th>
                                                <th scope="col" class="">Email</th>
                                                <th scope="col" class="">Phone No.</th>
                                                <th scope="col" class="">Created At</th>
                                                <th scope="col" class="">Last Update</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($admins as $admin)
                                                <tr class="">
                                                    <td class="">
                                                        {{ $i }}
                                                    </td>
                                                    <td class="">
                                                        {{ $admin->name }}
                                                    </td>
                                                    <td class="">
                                                        {{ $admin->email }}
                                                    </td>
                                                    <td class="">
                                                        {{ $admin->phoneNo }}
                                                    </td>
                                                    <td class="">
                                                        {{ $admin->created_at }}
                                                    </td>
                                                    <td class="">
                                                        {{ $admin->updated_at }}
                                                    </td>
                                                    <td class="">

                                                        <a href="\editAdminAccount\{{ $admin->id }}"
                                                            class="btn btn-primary">Edit</a>
                                                    </td>
                                                    <td class="">
                                                        <a href="\deleteAdminAccount\{{ $admin->id }}"
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
