@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Programme</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('addProgramme') }}">
                        @csrf
                        
                        <div class="col-md-10 ">
                            @if($errors->any())
                                <p class="text-center">{{$errors->first()}}</p>
                            @endif                                                     
                        </div>
                       
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <div class="row mb-3">
                            <label for="faculty" class="col-md-4 col-form-label text-md-end">{{ __('Faculty') }}</label>
                       
                            <div class="col-md-6">
                                @foreach ($faculties as $faculty => $faculty_name )
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="{{$faculty}}" name="facultyID" value="{{$faculty}}">{{ $faculty_name }}         
                                    <label class="form-check-label" for="radio{{$faculty}}"></label>                          
                                </div>                                
                                @endforeach
                                
                                @error('faculty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                                                     
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark" >
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
