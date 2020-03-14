@extends('layouts.app')

@section('content')

<h1>Edit Fact</h1>
<br><br>
    {!! Form::open(['action' => ['FactController@update', $fact->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    {{Form::hidden('_method','PUT')}}
        <div class="form-group text-center">
            {{Form::file('fact_image')}}
            <img class="col-md-4 d-inline-block" id='img' src="{{ url('/storage/facts_images/' .$fact->photo_path)}}">
        </div>
        <br>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', $fact->description, ['class' => 'form-control', 'placeholder' => 'Description Text'])}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
    
@endsection