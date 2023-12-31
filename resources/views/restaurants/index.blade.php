@extends('layouts.app')
@section('content')

<div class="row" style="text-align: center;">
<link rel="stylesheet" href="{{ asset('/css/tabelog.css') }}">
     <div class="col-2">
      @component('components.sidebar')
      @endcomponent
     </div>
     <div class="col-9">
         <div class="container">
             <div class="carousel-inner">
                 <div class="carousel-item active">
                     <img src="{{ asset('/img/nagoya.png')}}"  style="border-radius :8px;width:100%">
                     <div class="carousel-caption">
                         <h1 class="my_carousel_caption">
                           NAGOYAMESHI
                         </h1>
                     </div>
                 </div>
             </div>
             <br>
      
             <form>
                 <input type='text' name='keyword' placeholder="店舗検索" style="border-radius :8px;width:200px;">
                 <button type='submit' class="btn btn-primary">検索</button> 
             </form>
              @if ($category !== null)
              <label class="restaurant-category-label"><a href="{{ route('restaurants.index', ['category' => $category->id]) }}"></a></label> 
                 <h3>{{ $category->name }}検索結果{{$total_count}}件</h3>
                 <a href="{{ route('restaurants.index') }}">トップページに戻る</a>
              @endif
              <br>
              <h3 class="text-secondary" style="margin:20px 0px 5px 5px">カテゴリ検索</h3>
               @foreach($categories as $cate)
              <a href="{{ route('restaurants.index', ['category' =>$cate->id])}}" button type="button" class="btn btn-outline-secondary">
                {{$cate->name }}</a>
               @endforeach
         </div>
         <div class="col-12">
             <h3 style="margin:10px 0px 0px 20px">店舗一覧</h3>            
                @foreach($restaurants as $restaurant)
                 <div class="container py-4" style="width:100%">    
                     <div class="col">
                         <table class=table table-striped>
                             <a href="{{route('restaurants.show', $restaurant)}}">
                             @if ($restaurant->image && Illuminate\Support\Facades\File::exists($restaurant->image))
                                 <img src="{{asset($restaurant->image)}}" style="width:100%">
                             @else
                                 <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail" style="width:100%">                        
                             @endif
                             <tr>
                                 <th scope="col">店舗名： {{ $restaurant->name }}</th>
                             </tr>
                             <tr>
                                 <th scope="col">営業時間： {{ $restaurant->time }}</th>
                             </tr>
                             <tr>
                                 <th scope="col">定休日： {{ $restaurant->holiday }}</th>
                             </tr> 
                             <tr>
                                 <th scope="col"> カテゴリー： {{ $restaurant->category_id}}</th>
                             </tr>
                             </a>
                         </table>
                     </div>
                </div>
                @endforeach
         </div>       
     </div>
     <div class="d-flex justify-content-center">
         {{ $restaurants->appends(request()->query())->links() }}
     </div>
 </div>
@endsection
