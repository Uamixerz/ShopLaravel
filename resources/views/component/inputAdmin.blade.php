<div class="form-floating">

    <input
        name="{{$name}}"
        type="{{$type}}"
        class="form-control @error($name) is-invalid @enderror"
        id="{{$name}}"
        placeholder="{{$name}}"
        autocomplete='{{$name}}'
        @if(isset($value))
            value= '{{$value}}'
        @else
            value = '{{old($name)}}'
        @endif
        @if(isset($placeholder))
            placeholder='{{$placeholder}}'
        @endif
    >
    <label for="{{$name}}" class="form-label">@if(isset($labelInfo))
            {{$labelInfo}}
        @else
            {{$name}}
        @endif</label>
    @error($name)
    <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

