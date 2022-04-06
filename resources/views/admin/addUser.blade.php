@extends('layouts.app')

@section('content')
    <main>
        <div id="app">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 ">
                        <div class="card mt-5">
                            <div class="card-header ">Update Account Information</div>

                            <div class="card-body">
                                <form action="/updateUser" method="post">
                                    <input type="hidden" name="id" value="<%= user.id %> ">
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                                        <div class="col-md-6">

                                            <input type="text" name="name" id="name" placeholder="Micheal Jackson"
                                                class="form-control" value="<%= user.name %> " required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                                        <div class="col-md-6">
                                            <input type="text" name="email" id="email" placeholder="example@gmail.com"
                                                class="form-control" value="<%= user.email %>" required>

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                                        <div class="col-md-6">
                                            <input type="password" name="password" id="password" placeholder="Password!@123"
                                                class="form-control" value="" required>
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-success">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
