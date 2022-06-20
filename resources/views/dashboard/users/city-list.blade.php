@if(!empty( $cities ))
<ul class="list-group">
    @foreach ($cities as $city)
        <li class="list-group-item" 
            onclick="document.getElementById('city_id').value = '{{ $city->id }}';
            document.getElementById('city_name').value = '{{ $city->name }} - {{ $city->department->name }}';
            ">{{ $city->name }} - {{ $city->department->name }}</li>
    @endforeach
</ul>
@endif
