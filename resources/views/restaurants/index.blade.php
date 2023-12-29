@foreach ($restaurants as $restaurant)
{{ $restaurant->name }}
{{ $restaurant->category_id}}
{{ $restaurant->time }}
{{ $restaurant->holiday }}



<a href="{{ route('restaurants.show',$restaurant->id) }}">Show</a>
@endforeach