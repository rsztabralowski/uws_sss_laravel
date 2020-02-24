@extends('layouts.app')

@section('content')
<style>
    .row.mb-5 > a{
        margin-left: auto;
        margin-right: 20px;
    }

    img{
        width: 200px;
    }

    @media only screen and (max-width: 992px) {
        table{
            font-size: 12px;
        }
        img{
            width: 50px;
        }
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body overflow-auto">
                    <tr>
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
                                @can('is_admin')
                                    <th>Added by</th>
                                @endcan
                                <th>Action</th>
                            </tr>
                            @foreach ($user_facts as $fact)
                                <tr>
                                    <td>
                                        <img src="{{ url('/storage/facts_images/' .$fact->photo_path)}}">
                                    </td>
                                    <td class="description">{{$fact->description}}</td>
                                    @can('is_admin')
                                        <td>{{$fact->author->name}}</td>
                                    @endcan    
                                    <td>
                                        <div>
                                            <a href="{{route('facts.edit', $fact->id)}}"><button class="btn btn-primary btn-sm">Edit</button></a>
                                        </div>
                                        <br>
                                        {!!Form::open(['action' => ['FactController@destroy', $fact->id], 'method' => 'POST', 'class' => 'pull-right', 'onsubmit' => "return confirm('Are you sure you want to delete?')"])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])}}
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
