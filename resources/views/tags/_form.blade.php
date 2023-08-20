@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $massage)
                <li>{{$massage}}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{$action}}" method="post">
    @csrf
    @if($update)
        @method('put')
    @endif
    <div class="form-group mb-3">
        <label for="name">Tag Name:</label>
        <div class="mt-2">
            <input type="text" name="name" value="{{old('name',$tags->name)}}" class="form-control @error('name')is-invalid" @enderror   >
            @error('name')
            <p class="invalid-feedback">{{$massage}}</p>
            @enderror
        </div>
    </div>

    <div class="form-group ">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>

</form>
