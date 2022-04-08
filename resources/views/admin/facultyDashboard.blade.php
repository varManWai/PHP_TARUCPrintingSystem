@extends('layouts.admin')

@section('content')
    <main>
        <div id="app">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 ">
                        <div class="card mt-3">
                            <div class="card-header ">Lists of faculties available</div>

                            <div class="card-body table-responsive-xl">

                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="">
                                                <th scope="col" class="">No</th>
                                                <th scope="col" class="">Faculty</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                                
                                            @foreach ($faculties as $faculty=>$faculty_name)
                                                <tr class="">
                                                    <td class="">
                                                        {{ $i }}
                                                    </td>
                                                    <td class="">
                                                        {{ $faculty_name }}
                                                    </td>                                                    
                                                    <!-- <td class="">
                                                        <a href="\editUserAccount\{$faculty}}" class="btn btn-primary">Edit</a>
                                                    </td>                                                    -->
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
