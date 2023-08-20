@extends('layouts.defult')

@section('title','New Questions')


@section('content')
    <form action="{{route('questions.update',$question->id)}}" method="post">
        @csrf
        @method('put')
        <div class="form-group mb-3">
            <label for="title">Title</label>
            <div>
                <input type="text" class="form-control @error('title') is-invalid" @enderror name="title" value="{{old('title',$question->title)}}" name="title" >
                @error('title')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <div>
                <textarea class="form-control @error('description')is-invalid" @enderror rows="6" name="description" >
                    {{old('description',$question->description)}}
                </textarea>
                @error('description')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <button type="submit"class="btn btn-primary">Update Question</button>
        </div>

    </form>
@endsection
