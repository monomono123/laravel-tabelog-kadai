@foreach ($restaurants as $restaurant)
{{ $restaurant->name }}
{{ $restaurant->category_id}}
{{ $restaurant->time }}
{{ $restaurant->holiday }}

@if ($keyword !== null)
 <a href="{{ route('products.index') }}">トップ</a> > 商品一覧
 <h1>"{{ $keyword }}"の検索結果{{$total_count}}件</h1>
    @endif


<a href="{{ route('restaurants.show',$restaurant->id) }}">Show</a>
@endforeach