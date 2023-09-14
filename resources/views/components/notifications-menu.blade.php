@auth
<div class="ms-2 dropdown text-end">
    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="notifications">

        {{__('Notifications')}} <span class="badge bg-danger">{{$unreadCount}}</span>
</a>
<ul class="dropdown-menu text-small" aria-labelledby="notifications">
@foreach($notifications as $notification)

    <li><a class="dropdown-item" href="{{$notification->data['url']}}?notify_id={{$notification->id}}">
        <h6>{{$notification->data['title']}}</h6>
        <p>{{$notification->data['body']}}</p>
        <p class="text-muted">{{$notification->created_at->diffForHumans()}}</p>
    </a></li>

@endforeach
</ul>
</div>
@endauth

