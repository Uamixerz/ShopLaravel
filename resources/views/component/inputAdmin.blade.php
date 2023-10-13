<div class="mb-3 form-group">
    <label for="{{$name}}" class="form-label">Назва</label>
    <input
        name="{{$name}}"
        type="{{$type}}"
        class="form-control"
        id="{{$name}}"
        placeholder="{{$name}}"
        @if(isset($value))
            value= '{{$value}}'
        @else
            value = '{{old($name)}}'
        @endif
    >
    @error($name)
        <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
