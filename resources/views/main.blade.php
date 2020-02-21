@extends('layouts.app')

@section('content')
<style>
.facts{
    width:50%;
    margin: auto;
}

.card .row .content{
    text-align: center;
}

.card .row .content img{
    width: 90%;
    margin: auto;
    padding-top: 20px;
}
.description{
    width: 90%;
    margin: auto;
    background-color: cadetblue;
    font-size: calc(16px + 0.2vw);
    padding: 20px;
    color: aliceblue;
}

.pagination{
   justify-content: center;
   font-size: 25px;
}

@media only screen and (max-width: 970px) {
    .facts{
        width: 100%;
    }
}

</style>

<div class="facts">
@foreach ($facts as $fact)
    <div class="card mb-5">
        <div class="row">
            <div class="content">
                <img src="{{ url('/storage/facts_images/' .$fact->photo_path)}}">
                <div class="description mb-4">{{$fact->description}}</div>
                <div class="author float-left ml-4"><small><strong>Author: </strong>{{$fact->author->name}}</small></div>
            </div>
        </div>

        
    </div>

    
@endforeach
    <div class="pagination mb-5">{{ $facts->links() }}</div>
</div>
@endsection
