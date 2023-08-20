@extends('layouts.defult')

@section('title')
    <div >
        Questions<a href="{{route('questions.create')}}" class="btn btn-outline-primary btn-sm mx-3">New Question</a>
    </div>
@endsection

@section('content')

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{session()->get("success")}}
        </div>

    @endif

    @foreach($questions as $question)

    <div class="card mb-3 ">
        <div class="card-body">
            <h5 class="card-title"><a href="{{route('questions.show',['question'=>$question->id])}}">{{$question->title}}</h5>
            <div class="text-muted mb-4">
                Asked:{{$question->created_at->diffForHumans()}},   By:{{$question->user_name}}
            </div>
            <p class="card-text">{{Str::words($question->description,5) }}</p>
        </div>
        @if(\Illuminate\Support\Facades\Auth::id()==$question->user_id)
        <div class="card-footer">
            <div class="d-flex  justify-content-between">
                <div>
                    <a href="{{route('questions.edit',[$question->id])}}" class="btn btn-outline-dark">Edit</a>
                </div>
                <form action="{{route('questions.destroy',[$question->id])}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
        @endif
    </div>
    @endforeach
    {{$questions->links()}}

@endsection
