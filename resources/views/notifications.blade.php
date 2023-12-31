@extends('layouts.defult')
@section('content')

@section('title','Notifications')

<div>
    @foreach($notifications as $notification)
        <div class="card my-2">
            <a href="{{$notification->data['url']}}?notify_id={{$notification->id}}"/>
            <div class="card-body {{$notification->unread()?'bg-light fw-bold' : ''}}">
                <h4>{{$notification->data['title']}}</h4>
                <p>{{$notification->data['body']}}</p>
                <p class="text-muted">{{$notification->created_at->diffForHumans()}}</p>
            </div>
        </div>


    @endforeach
</div>

@endsection
