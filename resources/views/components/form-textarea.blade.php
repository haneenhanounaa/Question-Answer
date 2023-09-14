@props(['label','id','name','value'=>'']);
<label for="{{$id}}" > {{ $label }} </label>
<div>
    <textarea id="{{$id}}" class="form-control @error($name) is-invalid" @enderror  name="{{$name}}"   {{$attributes->class(['form-control',/*'is-invalid'=> $errors->has($description)*/])}}>
            "{{old($name,$value)}}"
    </textarea>
    @error($name)
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>
