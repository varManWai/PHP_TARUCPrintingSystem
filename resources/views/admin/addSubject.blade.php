@extends('layouts.admin')
<!--
author: Ho Wai Kit
-->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subject</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('addSubject') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="col-md-10 ">
                            @if($errors->any())
                                <p class="text-center">{{$errors->first()}}</p>
                            @endif                                                     
                        </div>
                       
                        <div class="row mb-3">
                            <label for="courseCode" class="col-md-4 col-form-label text-md-end">{{ __('Course Code') }}</label>

                            <div class="col-md-6">
                                <input id="courseCode" type="text" class="form-control @error('name') is-invalid @enderror" name="courseCode" value="{{ old('courseCode') }}" required autocomplete="courseCode" autofocus>
                                
                                @error('courseCode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('name') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                                
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pages" class="col-md-4 col-form-label text-md-end">{{ __('Pages') }}</label>

                            <div class="col-md-6">
                                <input id="pages" type="text" class="form-control @error('pages') is-invalid @enderror" name="pages" value="{{ old('pages') }}" required autocomplete="pages" autofocus>
                                
                                @error('pages')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>
                                
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" id="inputGroupFile02" name="image" required>                                    
                                </div>                                                            
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="programme" class="col-md-4 col-form-label text-md-end">{{ __('Programme (s)') }}</label>
                            
                            <div class="col-md-6">
                            @foreach ($programmes as $programme => $programme_name )                            
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="{{$programme}}" name="programmeID[]" value="{{$programme}}">
                                    <label class="form-check-label">{{$programme_name}}</label>
                                </div>                                                               
                            @endforeach
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
