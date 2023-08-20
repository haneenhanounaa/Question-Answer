@extends('layouts.defult')
@push('styles')
   <link rel="stylesheet" href="style.css">
@endpush

@section('title')
    <h2 class="mb-4">Edit New Tag</h2>
@endsection
@section('content')

    @include('tags._form',[
             'action'=>'/tags/'.$tags->id,
             'update'=>true
        ])
@endsection

