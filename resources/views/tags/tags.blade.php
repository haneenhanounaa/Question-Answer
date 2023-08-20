@extends('layouts.defult')

@section('title')
    {{$title}}
    <a class="btn btn-outline-dark btn-xs" href="/tags/create">ADD NEW</a>
@endsection

@section('content')


        @if(session()->has('succes'))
            <div class="alert alert-success">
                {{session()->get("succes")}}
            </div>

        @endif
        @if(\Illuminate\Support\Facades\Auth::check())
            <div>User:{{$user->name}}</div>
            <div>User:{{$user->email}}</div>
        @endif


        <table class="table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>SLug</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                <tr>
                    <td>{{$tag->id}}</td>
                    <td><a href='/tags/{{$tag->id}}/edit'>{{$tag->name}}</a></td>
                    <td>{{$tag->slug}}</td>
                    <td>{{$tag->created_at}}</td>
                    <td>{{$tag->updated_at}}</td>
                    <td>
                        <form class="delete-form" action="/tags/{{$tag->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>

                        </form>
                    </td>
                </tr>
                 @endforeach
            </tbody>

        </table>
    <script>
        setTimeout(function (){
            document.querySelector('.alert').style.display='none'
        },5000)
        // document.querySelector(".delete-form").addEventListener('submit',function(e){
        //     e.preventDefault();
        //     if(confirm("Are you sure to delete ?")){
        //         e.target.submit();
        //     }
        // })
    </script>
@endsection
