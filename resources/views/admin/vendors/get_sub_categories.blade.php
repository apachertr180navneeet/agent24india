<option value="">Select</option>
@foreach($subCategories as $key => $value)
    <option value="{{$value->id}}">{{$value->name}}</option>
@endforeach