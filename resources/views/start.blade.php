@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Session::has('Error'))
            <div class="alert alert-danger fade-message"> {{Session::get('Error')}}</div>
        @endif
            @if(Session::has('Quiz'))
                <div class="alert alert-success fade-message"> {{Session::get('Quiz')}}</div>
            @endif
            @if(Session::has('Take_Quiz_Again'))
                <div class="alert alert-danger fade-message"> {{Session::get('Take_Quiz_Again')}}</div>
            @endif

        <div class="alert alert-info">
            <h2>What is the Quiz you want to Start it ?
                <br> <h4>Select One from that
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down-square-fill ml-2"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 5a.5.5 0 0 0-1 0v4.793L5.354 7.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 9.793V5z"/>
                    </svg>
                </h4>
            </h2>
        </div>
        <form action="{{route('Test.Quiz')}}" method="post">
            @csrf
            @foreach($exam as $exams)
                <input class="mt-2" type="radio" name="{{$exams->id}}" value="{{$exams->ExamName}}">{{$exams->ExamName}}<br>
            @endforeach
            <input type="submit" class="btn btn-primary" name="Send" value="Send">
        </form>
    </div>
    {{--<form action="{{route('role')}}" method="post">
        @csrf
        <input type="text" name="role_name"><br>
        <input type="checkbox" name="show_option[]" value="User">User<br>
        <input type="checkbox" name="show_option[]" value="Admin">Admin<br>
        <input type="submit" value="Send">
    </form>--}}
@endsection

@section('script')
    <script>
        $(function(){
            setTimeout(function() {
                $('.fade-message').remove();
            }, 3000);
        });
    </script>
@endsection





