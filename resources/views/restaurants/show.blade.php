
@auth
<form method="POST" class="m-3 align-items-end">
  @csrf
  <input type="hidden" name="id" value="{{$restaurant->id}}">
                 <input type="hidden" name="name" value="{{$restaurant->name}}">
                 <input type="hidden" name="price" value="{{$restaurant->price}}">
                 <div class="form-group row">

@if(Auth::user()->favorite_restautants()->where('restaurant_id', $restaurant->id)->exists())
    <a href="{{ route('favorites.destroy', $restaurant->id) }}" class="btn btn-success text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();">
      <i class="fa fa-heart"></i>
      お気に入り解除
    </a>
  @else
   <a href="{{ route('favorites.store', $restaurant->id) }}" class="btn btn-success text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();">
    <i class="fa fa-heart"></i>
     お気に入り
  </a>
 @endif
</div>

 </form>
 <form id="favorites-destroy-form" action="{{ route('favorites.destroy', $restaurant->id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
  </form>
  <form id="favorites-store-form" action="{{ route('favorites.store', $restaurant->id) }}" method="POST" class="d-none">
     @csrf
</form>
@endauth


<div class="offset-1 col-11">
   <hr class="w-100">
    
 </div>

 <div class="offset-1 col-10">
    <div class="row">
 @foreach($reviews as $review)
       <div class="offset-md-5 col-md-5">
           <h3 class="review-score-color">{{ str_repeat('★', $review->score) }}</h3>
              <p class="h3">{{$review->title}}</p>
              <p class="h3">{{$review->content}}</p>
              <label>{{$review->created_at}} {{$review->user->name}}</label>
        </div>
  @endforeach
     </div><br />

 <br>
 
 @auth
 <div class="row">
   <div class="offset-md-5 col-md-5">
     <form method="POST" action="{{ route('reviews.store') }}">
       @csrf
       <h4>評価</h4>
         <select name="star" class="form-control m-2 review-star">
          <option value="5" class="review-star">★★★★★</option>
           <option value="4" class="review-star">★★★★</option>
           <option value="3" class="review-star">★★★</option>
           <option value="2" class="review-star">★★</option>
           <option value="1" class="review-star">★</option>
         </select>
       <h4>レビュー内容</h4>
       @error('content')
       <strong>レビュー内容を入力してください</strong>
       @enderror
       <textarea name="content" class="form-control m-2"></textarea>
       <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
       <button type="submit" class="btn btn-success ml-2">レビューを追加</button>
     </form>
   </div>
 </div>
@endauth
     </div>
   </div>
 </div>
 