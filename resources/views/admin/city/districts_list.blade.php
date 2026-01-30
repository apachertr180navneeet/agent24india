<!-- <select class="form-control select-picker" id="district_id" name="district_id"> -->
    <option value="">-Select-</option>
    @foreach($districts as $key => $value)
        <option value="{{$value->id}}">{{$value->name}}</option>
    @endforeach
<!-- </select> -->