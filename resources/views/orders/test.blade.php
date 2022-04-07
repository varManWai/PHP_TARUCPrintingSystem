@extends('layouts.app')
@php
    use App\Models\subject;
@endphp
@section('content')
    <div class="container">
       @foreach ($subjectIDs as $item)
           @php
               $subject = subject::where('subjectID',$item->subjectID)
                ->get();
                $subject = $subject->toArray();
                print_r($subject);
                echo $subject[0]['title'];
           @endphp
       @endforeach
    </div>
@endsection