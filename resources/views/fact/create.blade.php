@extends('layouts.app')

@section('content')

<h1>Create Fact</h1>
<br><br>
    {!! Form::open(['action' => 'FactController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::file('fact_image')}}
        </div>
        <br>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Description Text'])}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
    
@endsection