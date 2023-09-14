@extends('layouts.defult')

@section('title','Edit Profile')


@section('content')
    <form action="{{route('profile')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <div>
                <input type="text" class="form-control @error('name') is-invalid" @enderror name="name" value="{{old('name',$user->name)}}" name="name" >
                @error('name')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email Address</label>
            <div>
                <input type="email" class="form-control @error('email') is-invalid" @enderror name="email" value="{{old('email',$user->email)}}" name="email" >
                @error('email')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="profile_photo">Profile Photo</label>
            <div>
                <input type="file" class="form-control @error('profile_photo') is-invalid" @enderror name="profile_photo" >
                @error('profile_photo')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>




        <div class="form-group">
            <button type="submit"class="btn btn-primary">Update Profile</button>
        </div>

    </form>
@endsection
