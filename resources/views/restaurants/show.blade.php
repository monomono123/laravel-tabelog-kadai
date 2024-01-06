@extends('layouts.app')
@section('content') 


@if (session('message'))
{{ session('message') }}
@endif
<link rel="stylesheet" href="{{ asset('/css/tabelog.css') }}">
 <div style="width:40rem;margin:5rem auto;">
 </div>

 @auth
    @if(Auth::user()->favorite_restaurants()->where('restaurant_id', $restaurant->id)->exists())
      <a href="{{ route('favorites.destroy', $restaurant->id) }}" class="btn btn-outline-warning text-favorite" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();" style="margin:10px;widht:100%">
       <i class="fa fa-heart"></i>
        お気に入り解除
      </a>

    @else
      <a href="{{ route('favorites.store', $restaurant->id) }}" class="btn btn-outline-warning text-favorite" onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();" style="margin:10px;widht:100%">
         <i class="fa fa-heart"></i>
          お気に入り
       </a>
       @endif

       <form id="favorites-destroy-form" action="{{ route('favorites.destroy', $restaurant->id) }}" method="POST" class="d-none">
                     @csrf
                     @method('DELETE')
                 </form>
                 <form id="favorites-store-form" action="{{ route('favorites.store', $restaurant->id) }}" method="POST" class="d-none">
                     @csrf
                 </form>

                            
    @endauth

            <div class="card">
                <img src="{{ asset('/img/dummy.png') }}" alt="{{ $restaurant->name }}" class="card-img-top">
                    <div class="card-body">
                        <div class="card-text">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">平均評価</th>
                                    <td>{{ $restaurant->reviews->avg('star') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">詳細</th>
                                    <td>{{ $restaurant->discription}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">価格帯</th>
                                    <td>{{ $restaurant->pricelower }}円～{{ $restaurant->priceupper }}円</td>
                                </tr>
                                <tr>
                                    <th scope="row">営業時間</th>
                                    <td>{{ $restaurant->time }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">定休日</th>
                                    <td>{{ $restaurant->holiday }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">住所</th>
                                    <td>{{ $restaurant->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a class="btn btn-primary" href="{{ route('reservations.create',['restaurant_id' => $restaurant->id]) }}" role="button">予約する</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="offset-1 col-10">
          <div class="row">
                 @foreach($reviews as $review)
                 
                     <p class="h3">{{$review->content}}</p>
                     <p class="h3">{{$review->star}}:{{str_repeat('★',$review->star)}}</p>
                     <label>{{$review->created_at}} {{$review->user->name}}</label>
                 </div>
                 @endforeach
             </div><br />
 
             @auth
             <div class="row">
                
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
                         <input type="hidden" name="image" value="{{$restaurant->image}}">
                         <button type="submit" class="btn btn-success" style="margin: 10px;">レビュー追加</button>
                     </form>
                 </div>
             </div>
          </div>
    @endauth

    <a class="btn btn-outline-dark text-right" href="{{route('restaurants.index')}}" style="margin: 10px;">戻る</a>

@endsection