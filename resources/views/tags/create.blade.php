@extends('layouts.defult')
@section('title')
    <h2 class="mb-4">Create New Tag</h2>
@endsection

@section('content')
    @include('tags._form',[
        'action'=>'/tags',
        'update'=>false

    ])

@endsection
