@extends('layouts.app')

@section('content')
                <h2>


                    {{-- here in the $choose->question->Category
                    we use the relation question to access the category and we use it like this because we not use the
                    get method we use (find method)
                    --}}
                    {{--{{$choose->question->Category}}--}}

                    {{-- here we use the foreach
                    to get all the properties becasue we use (get method) get method is get collection of data so for that reasone
                    we use the foreach to get the collection of data

                    --}}

                    {{--@foreach($choose as $chooses)
                        <li>{{$chooses->question->Category}}</li>
                        <li>{{$chooses->Question}}</li>
                        <li>{{$chooses->OptionText}}</li>
                        <li>{{$chooses->Points}}</li>
                        <li>{{$chooses->Answer}}</li>

                    @endforeach
    --}}
                </h2>

                <div class="container" style="width: 60rem;">
                    <div class="mr-5" style="background-color: darkslategray;color:whitesmoke; text-align: center; border-radius: 3%;">
                        <h3>Quiz About {{$ExName->ExamName}}</h3>
                    </div>
                    <form method="post" action="{{route('Test.store')}}" >
                        @csrf
                        <input type="hidden" name="exam" value="{{$ExName->ExamName}}">
                        <input type="hidden" name="examID" value="{{$ExName->id}}">
                        @foreach($choose as $chooses)
                            <div class="card mt-3" style="width: 50rem;">
                                <ul class="list-group list-group-flush">
                                    <h3><li class="list-group-item">{{$chooses->Question}}</li></h3>
                                    @for($i=0;$i<count($chooses->OptionText);$i++)
                                        {{-- here we put the $chooses->id to make the select is changeable in foreach any time
                                              if we make in the name any name then from all the select in the page that will select
                                              one of radio so for that reason we make the with the (id)
                                                        --}}
                                        <div class="input-group mt-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="radio" name="{{$chooses->id}}" value="{{$chooses->OptionText[$i]}}"  aria-label="Radio button for following text input" required>

                                                </div>
                                            </div>
                                            <li class="list-group-item form-control ">{{$chooses->OptionText[$i]}}</li>
                                        </div>
                                    @endfor
                                </ul>
                            </div>
                        @endforeach

                        <input type="submit" name="Send" value="Send" class="btn btn-primary mt-3">
                    </form>
                </div>

@endsection



