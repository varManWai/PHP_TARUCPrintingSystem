{{-- Author:Lai Man Wai --}}

@extends('layouts.admin')

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

                                <form method="POST" action="{{ route('editSupplierName') }}">
                                    @csrf
                                    <div class="row mb-5 mt-3">
                                        <label for="name"
                                            class="col-md-3 col-form-label text-md-end">{{ __('Name') }}</label>

                                        <div class="col-md-3">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name2"
                                                value="{{ $user->name }}" autocomplete="name" autofocus
                                                placeholder="Micheal Jackson" disabled>
                                        </div>

                                        <div class="col-md-3">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus
                                                placeholder="username">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="userID" value="{{ $userID }}" />

                                        <div class="col-md-1 ">
                                            <button type="submit" class="btn btn-dark">
                                                {{ __('Update') }}
                                            </button>
                                        </div>

                                    </div>
                                </form>

                                <hr style="color: transparent" />

                                <form method="POST" action="{{ route('editSupplierEmail') }}">
                                    @csrf
                                    <div class="row mb-5">
                                        <label for="email"
                                            class="col-md-3 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                        <div class="col-md-3">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email2"
                                                value="{{ $user->email }}" autocomplete="email"
                                                placeholder="example@gmail.com" disabled>

                                        </div>

                                        <div class="col-md-3">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('name') }}" required autocomplete="email"
                                                placeholder="example@mail.com">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="userID" value="{{ $userID }}" />

                                        <div class="col-md-1 ">
                                            <button type="submit" class="btn btn-dark">
                                                {{ __('Update') }}
                                            </button>
                                        </div>

                                    </div>
                                </form>

                                <hr style="color: transparent" />

                                <form method="POST" action="{{ route('editSupplierPassword') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="password"
                                            class="col-md-3 col-form-label text-md-end">{{ __('Password') }}</label>

                                        <div class="col-md-5">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="new-password" placeholder="Password@123">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="password-confirm"
                                            class="col-md-3 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-5">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password"
                                                placeholder="Password@123">
                                        </div>
                                    </div>

                                    <input type="hidden" name="userID" value="{{ $userID }}" />

                                    <div class="row justify-content-end mb-5">
                                        <div class="col-md-9">
                                            <button type="submit" class="btn btn-dark">
                                                {{ __('Update') }}
                                            </button>
                                        </div>
                                    </div>


                                </form>

                                <hr style="color: transparent" />


                                <form method="POST" action="{{ route('editSupplierPhoneNo') }}">
                                    @csrf
                                    <div class="row mb-5">
                                        <label for="phoneNo"
                                            class="col-md-3 col-form-label text-md-end">{{ __('PhoneNo') }}</label>

                                        <div class="col-md-3">
                                            <input id="phoneNo" type="phoneNo"
                                                class="form-control @error('phoneNo') is-invalid @enderror" name="phoneNo2"
                                                value="{{ $user->phoneNo }}" required autocomplete="phoneNo"
                                                placeholder="01X-XXXXXXX" disabled>


                                        </div>
                                        <div class="col-md-3">
                                            <input id="phoneNo" type="phoneNo"
                                                class="form-control @error('phoneNo') is-invalid @enderror" name="phoneNo"
                                                value="{{ old('phoneNo') }}" required autocomplete="phoneNo"
                                                placeholder="01X-XXXXXXX">

                                            @error('phoneNo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="userID" value="{{ $userID }}" />

                                        <div class="col-md-1 ">
                                            <button type="submit" class="btn btn-dark">
                                                {{ __('Update') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <hr style="color: transparent" />


                                <form method="POST" action="{{ route('editSupplierShopName') }}">
                                    @csrf
                                    <div class="row mb-5">
                                        <label for="shopName"
                                            class="col-md-3 col-form-label text-md-end">{{ __('Shop Name') }}</label>

                                        <div class="col-md-3">
                                            <input id="shopName" type="text"
                                                class="form-control @error('shopName') is-invalid @enderror"
                                                name="shopName2" value="{{ $user->shopName }}"
                                                autocomplete="shopName" disabled>


                                        </div>

                                        <div class="col-md-3">
                                            <input id="shopName" type="shopName"
                                                class="form-control @error('shopName') is-invalid @enderror"
                                                name="shopName" value="{{ old('shopName') }}" required
                                                autocomplete="shopName">

                                            @error('shopName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="userID" value="{{ $userID }}" />

                                        <div class="col-md-1 ">
                                            <button type="submit" class="btn btn-dark">
                                                {{ __('Update') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <form method="POST" action="{{ route('editSupplierLocation') }}">
                                    @csrf
                                    <div class="row mb-5">
                                        <label for="location"
                                            class="col-md-3 col-form-label text-md-end">{{ __('Location') }}</label>

                                        <div class="col-md-3">
                                            <input id="location" type="location"
                                                class="form-control @error('location') is-invalid @enderror"
                                                name="location2" value="{{ $user->location }}"
                                                autocomplete="location" disabled>


                                        </div>

                                        <div class="col-md-3">
                                            <input id="location" type="location"
                                                class="form-control @error('location') is-invalid @enderror"
                                                name="location" value="{{ old('location') }}" required
                                                autocomplete="location">

                                            @error('location')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="userID" value="{{ $userID }}" />

                                        <div class="col-md-1 ">
                                            <button type="submit" class="btn btn-dark">
                                                {{ __('Update') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <div class="d-flex justify-content-center my-5">
                                    <div class="col-md-2">
                                        <a href="{{ route('deleteSupplierAccount', ['id' => $user->id]) }}" class="btn btn-danger " >Delete Account</a>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="{{ route('suppliersDashboard') }}" class="btn btn-dark " >Back</a>
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
