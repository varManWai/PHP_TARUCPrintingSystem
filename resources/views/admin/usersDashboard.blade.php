@extends('layouts.app')

@section('content')
    <main>
        <div id="app">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 ">
                        <div class="card mt-3">
                            <a href="\addUser" class="btn btn-dark"> Add New User</a>
                        </div>
                        <div class="card mt-3">



                            <div class="card-header ">User Account Management</div>

                            <div class="card-body table-responsive-xl">
                                <% //if (users.length <=0) { %>
                                <h2>Nothing here</h2>

                                <% //} else { %>
                                <table class="table  table-hover">
                                    <thead>
                                        <tr class="">
                                            <th scope="col" class="">No</th>
                                            <th scope="col" class="">Name</th>
                                            <th scope="col" class="">Email</th>
                                            <th scope="col" class=""></th>
                                            <th scope="col" class=""></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <% //let i=1;
                                                    //users.forEach(user=> { %>
                                        // <tr class="">
                                        //     <td class="">
                                        //         <%= //i %>
                                        //     </td>
                                        //     <td class="">
                                        //         <%= //String(user.name) %>
                                        //     </td>
                                        //     <td class="">
                                        //         <%= //String(user.email) %>
                                        //     </td>
                                        //     <td class="">
                                        //         <a href="/updateUser/<%= //user.id %>" class="btn btn-success">Edit</a>
                                        //     </td>
                                        //     <td class="">
                                        //         <a href="/deleteUser/<%= //user.id %>" class="btn btn-danger">Delete</a>
                                        //     </td>
                                        // </tr>
                                        <% //i++; }); %>
                                    </tbody>
                                </table>
                                <% //} %>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection