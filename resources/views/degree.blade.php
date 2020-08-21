@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Session::has('Sucess'))
            <div class="alert alert-success fade-message"> {{Session::get('Sucess')}}</div>
        @endif
        <div class="alert alert-success">
            <h2>{{Auth::user()->name}}</h2> Your Degree is
            @if(isset($degree) && $degree > 0)
                {{$degree}} Congratulation
            @else
                {{$degree}} You should Work Hard
            @endif
        </div>
         <a href="{{route('Test.Start')}}" class="btn btn-primary mt-4">click here back to start</a>
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

        $(function(){
            setTimeout(function() {
                $('.fade-message2').remove();
            }, 6000);
        });
    </script>
@endsection
