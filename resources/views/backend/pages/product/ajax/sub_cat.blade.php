@foreach ($subCat as $data )
<option label="Choose country"></option>
    <option value="{{ $data->id }}">{{ $data->sub_category_name }}</option>
@endforeach