@foreach ($childCat as $data )
<option label="Choose country"></option>
    <option value="{{ $data->id }}">{{ $data->child_category_name }}</option>
@endforeach