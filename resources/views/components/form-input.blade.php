@props(['label','id','name','value'=>'']);
<label for="{{$id}}" > {{ $label }} </label>
<div>
    <input type="text" id="{{$id}}" class="form-control @error($name) is-invalid" @enderror  name="{{$name}}"  value="{{old($name,$value ?? null)}}">
    @error($name)
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>

{{--<label for="title">Title</label>--}}
{{--<div>--}}
{{--    <input type="text" class="form-control @error('title') is-invalid" @enderror  value="{{old('title')}}" name="title">--}}
{{--    @error('title')--}}
{{--    <p class="invalid-feedback">{{$message}}</p>--}}
{{--    @enderror--}}
{{--</div>--}}
