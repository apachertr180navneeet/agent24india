<option value="">Select</option>
@foreach($cities as $key => $value)
    <option value="{{$value->id}}">{{$value->name}}</option>
@endforeach