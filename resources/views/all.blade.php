@extends('layouts.app')

@section('content')

{!!'<pre>'!!}
{{print_r($all_facts->toArray())}}
{!!'</pre>'!!}
    
@endsection
