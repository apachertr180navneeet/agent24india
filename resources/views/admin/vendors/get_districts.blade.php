<option value="">Select</option>
@foreach($districts as $key => $value)
    <option value="{{$value->id}}">{{$value->name}}</option>
@endforeach