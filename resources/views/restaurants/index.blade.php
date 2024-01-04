@foreach ($restaurants as $restaurant)
{{ $restaurant->name }}
{{ $restaurant->category_id}}
{{ $restaurant->time }}
{{ $restaurant->holiday }}

<a href="{{ route('restaurants.show',$restaurant->id) }}">Show</a>
<div class="container">
  @if ($category !== null)
    <a href="{{ route('restaurants.index') }}">トップ</a> > <a href="#">{{ $category->category_name }}</a> > {{ $category->name }}
     <h1>{{ $category->name }}の商品一覧{{$total_count}}件</h1>
   @endif
 </div>

 {{ $restaurants->appends(request()->query())->links() }}
@endforeach