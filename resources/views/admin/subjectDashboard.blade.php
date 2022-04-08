@extends('layouts.admin')

@section('content')
    <main>
        <div id="app">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 ">
                                                      
                            <a href="/xmlSubject" class="btn btn-dark btn-sm" role="button" aria-pressed="true">View in XML form</a> 
                            <div class="card-header ">Lists of subjects available</div> 
                             
                            <div class="card-body table-responsive-xl">

                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="">
                                                <th scope="col" class="">No</th>
                                                <th scope="col" class="">Course Code</th>
                                                <th scope="col" class="">Title</th> 
                                                <th scope="col" class="">Pages</th>  
                                                <th scope="col" class="">Price (RM)</th>  
                                                <th scope="col" class="">Image</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                                
                                            @foreach ($subjects as $subject)
                                                @php                                                
                                                $fileName = substr($subject['image'],22);
                                                @endphp
                                                <tr class="">
                                                    <td class="">
                                                        {{ $i }}
                                                    </td>
                                                    <td class="">
                                                        {{$subject['courseCode']}}
                                                    </td>
                                                    <td class="">
                                                        {{$subject['title']}}
                                                    </td>
                                                    <td class="">
                                                        {{$subject['pages'] }}
                                                    </td>   
                                                    <td class="">
                                                        {{$subject['price'] }}
                                                    </td> 
                                                    <td class="">  
                                                        <div class="" style="max-height: 10rem; max-width:20rem;overflow:hidden;">                                                                                                                                                                                                     
                                                            <img src="{{ asset('storage/image/subjects/'.$fileName.'') }}" class="card-img-top" alt="...">
                                                        </div>
                                                    </td>                                                  
                                                    <!-- <td class="">
                                                        <a href="\editProgramme\{$subject['subjectid']}}" class="btn btn-primary">Edit</a>
                                                    </td>     -->
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
