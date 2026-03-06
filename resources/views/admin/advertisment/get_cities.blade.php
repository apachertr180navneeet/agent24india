<option value="">-Select-</option>
@if(isset($cities) && count($cities) > 0)
    @foreach($cities as $value)
        <option value="{{ $value->id }}">{{ $value->name }}</option>
    @endforeach
@endif
