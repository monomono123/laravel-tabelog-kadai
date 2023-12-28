@foreach ($restaurants as $restaurant)
{{ $restaurant->name }}


<a href="{{ route('restaurants.show',$restaurant->id) }}">Show</a>
@endforeach