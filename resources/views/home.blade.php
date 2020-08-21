@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Session::has('Error'))
                        <div class="btn btn-danger fade-message"> {{Session::get('Error')}}</div>
                        @endif
                    {{ __('You are logged in!') }} <a href="{{route('Test.Start')}}" class="btn btn-primary">Go Quiz</a>
                </div>
            </div>
        </div>
    </div>
</div>
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
