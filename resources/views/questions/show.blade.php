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

        <div class="card mb-3 ">
            <div class="card-body">
                <h5 class="card-title">{{$question->title}}</h5>
                <div class="text-muted mb-4">
                    Asked:{{$question->created_at->diffForHumans()}},   By:{{$question->user_name}}
                </div>
                <p class="card-text">{{$question->description }}</p>
            </div>
        </div>



@endsection
