@extends('layouts.app')
@section('content') 

@if (session('message'))
{{ session('message') }}
@endif
<link rel="stylesheet" href="{{ asset('/css/tabelog.css') }}">
 <div style="width: 100%;">
 
 <div style="width:40rem;margin:5rem auto;">
 </div>
 
 
            <div class="card" style="width:40rem;margin:5rem auto;">
                <img src="{{ asset($restaurant->image) }}" alt="{{ $restaurant->name }}" class="card-img-top">
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


    @auth
    @if(Auth::user()->favorite_restaurants()->where('restaurant_id', $restaurant->id)->exists())
      <a href="{{ route('favorites.destroy', $restaurant->id) }}" class="btn btn-outline-warning text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();">
       <i class="fa fa-heart"></i>
        お気に入り解除
      </a>
    @else
      <a href="{{ route('favorites.store', $restaurant->id) }}" class="btn btn-outline-warning text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();">
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

       <div class="offset-1 col-10">
          <div class="row">
                 @foreach($reviews as $review)
                 <div class="offset-md-5 col-md-5">
                     <p class="h3">{{$review->content}}</p>
                     <p class="h3">{{$review->star}}:{{str_repeat('★',$review->star)}}</p>
                     <label>{{$review->created_at}} {{$review->user->name}}</label>
                 </div>
                 @endforeach
             </div><br />
 
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
                         <input type="hidden" name="image" value="{{$restaurant->image}}">
                         <button type="submit" class="btn btn-success">レビュー追加</button>
                     </form>
                 </div>
             </div>
          </div>

    @endauth

@endsection