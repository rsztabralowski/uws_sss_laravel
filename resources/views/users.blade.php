@extends('layouts.app')

@section('content')
<style>
    .row.mb-5 > a{
        margin-left: auto;
        margin-right: 20px;
    }

    @media only screen and (max-width: 992px) 
    {
        table{
            font-size: 12px;
        }

        .container{
            padding-right: 0px;
            padding-left: 0px;
        }

        .col-md-8{
            padding-right: 0px;
        }
              
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">Users</div>
                <div class="card-body overflow-auto">
                    
                    <table class="table table-hover">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>N<sup>o</sup></th>
                            <th>Action</th>
                        </tr>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->facts_count}}</td>
                            <td>
                                <a class="btn btn-sm btn-danger" href="{{ route('users.delete', $user->id) }}">
                                    {{ __('Delete') }}
                                </a>
                            </td>    
                        </tr>    
                        @empty
                            <tr>
                                <td colspan="3">There are no users to display</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
            <br><br><hr><br><br>
            <div class="card">
                <div class="card-header">Removed Users</div>
                <div class="card-body overflow-auto">
                    <table class="table table-hover">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>N<sup>o</sup></th>
                            <th>Action</th>
                        </tr>
                    @forelse ($users_removed as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->facts_count}}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('users.restore', $user->id) }}">
                                    {{ __('Restore') }}
                                </a>
                            </td>    
                        </tr>    
                        @empty
                            <tr>
                                <td colspan="3">There are no users to display</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection