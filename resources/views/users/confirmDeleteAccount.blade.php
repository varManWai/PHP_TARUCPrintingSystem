@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">{{ __('Delete confirmation') }}</div>

                    <div class="card-body p-3">

                        <div class="row mb-3">
                            <p>Do you want to delete account? </p><br />
                            <p><strong>Warning: All your user information will lose!</strong></p>
                        </div>

                        <form method="POST" action="{{ route('deletedAccount') }}">
                            @csrf
                            <div class="row " style="display:flex;justify-content:space-between">
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-danger">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                                <div class="col-md-2 mx-2">
                                    <a href="/editUser" class="btn btn-white" style="border: grey 1px solid">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
