@extends('layouts.defult')

@section('title','New Questions')


@section('content')
    <form action="{{route('questions.store')}}" method="post">
        @csrf
        <div class="form-group mb-3">
{{--           <x-form-input  id="title" name="title" label=" Question Title" value=""/>--}}
            <label for="title">Title</label>
            <div>
                <input type="text" class="form-control @error('title') is-invalid" @enderror  value="{{old('title')}}" name="title">
                @error('title')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="description">Description</label>
            <div>
                <textarea class="form-control @error('description')is-invalid" @enderror rows="6" name="description" >
                    {{old('description')}}
                </textarea>
                @error('description')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>



        <div class="form-group mb-3">
            <label for="">Tags</label>
            <div>
                @foreach($tags as $tag )
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{$tag->id}}" id="{{$tag->id}}">
                    <label class="form-check-label" for=" tag-{{$tag->id}}">
                        {{$tag->name}}
                    </label>
                </div>
                @endforeach

            </div>
        </div>

        <div class="form-group">
            <button type="submit"class="btn btn-primary">Ask Question</button>
        </div>

    </form>
@endsection
