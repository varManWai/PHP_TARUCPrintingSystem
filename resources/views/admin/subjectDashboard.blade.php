@extends('layouts.admin')

@section('content')
    <main>
        <div id="app">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 ">
                        <div class="card mt-3">
                            <div class="card-header ">Lists of subjects available</div>

                            <div class="card-body table-responsive-xl">

                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="">
                                                <th scope="col" class="">No</th>
                                                <th scope="col" class="">Course Code</th>
                                                <th scope="col" class="">Title</th> 
                                                <th scope="col" class="">Pages</th>  
                                                <th scope="col" class="">Price</th>  
                                                <th scope="col" class="">Image</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                                
                                            @foreach ($subjects as $subject)
                                                <tr class="">
                                                    <td class="">
                                                        {{ $i }}
                                                    </td>
                                                    <td class="">
                                                        {{$programme['programme_name']}}
                                                    </td>
                                                    <td class="">
                                                        {{$programme['faculty_name'] }}
                                                    </td>                                                    
                                                    <td class="">
                                                        <a href="\editProgramme\{$programme['programmeID']}}" class="btn btn-primary">Edit</a>
                                                    </td>                                                   
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
