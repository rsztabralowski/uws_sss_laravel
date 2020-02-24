@extends('layouts.app')

@section('content')

<h1>Edit Fact</h1>
<br><br>
    {!! Form::open(['action' => ['FactController@update', $fact->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    {{Form::hidden('_method','PUT')}}
        <div class="form-group">
            {{Form::file('fact_image')}}
        </div>
        <br>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', $fact->description, ['class' => 'form-control', 'placeholder' => 'Description Text'])}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
    
@endsection