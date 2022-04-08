{{-- Author:Lai Man Wai --}}

@extends('layouts.admin')

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

                            <div class="card-header ">Users Account Management</div>

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
                                                <th scope="col" class="">Created At</th>
                                                <th scope="col" class="">Programme</th>
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
                                                        {{ $user->programmeName }}
                                                    </td>
                                                    <td class="">

                                                        <a href="{{ route('editUserAccount', ['id' => $user->id]) }}"
                                                            class="btn btn-primary">Edit</a>
                                                    </td>
                                                    <td class="">
                                                        <a href="{{ route('deleteUserAccount', ['id' => $user->id]) }}"
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
