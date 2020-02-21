@extends('layouts.app')

@section('content')
<style>
    .row.mb-5 > a{
        margin-left: auto;
        margin-right: 20px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row mb-5">
                        <a href="{{route('facts.create')}}"><button class="btn btn-success" id="addNew">Add new fact</button></a>
                    </div>
                    
                    @if ($user_facts->isEmpty())
                        <div>You have not added any facts yet</div>
                    @else
                        <table class="table table-hover">
                            <tr>
                                <th>Photo</th>
                                <th>Fact</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($user_facts as $fact)
                                <tr>
                                    <td style="width:210px">
                                        <img style="width:200px" src="{{ url('/storage/facts_images/' .$fact->photo_path)}}">
                                    </td>
                                    <td>{{$fact->description}}</td>    
                                    <td>
                                        {!!Form::open(['action' => ['FactController@destroy', $fact->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}    
                                    </td>    
                                </tr>    
                            @endforeach

                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
