@extends('layouts.app')

@section('content')

@foreach ($facts as $fact)

{{$fact->description}}
    
@endforeach
    
@endsection
