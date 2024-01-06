@extends('layouts.app')

@section('content')

<html>
    <head>
<h1>{{$restaurant->name}}</h1>
<form action="{{ route('reservations.store') }}" method="POST">
<link rel="stylesheet" href="{{ asset('/css/tabelog.css') }}">

    @csrf
    @if (isset($errors))
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
  @endif

    @error('reservationnumber')
        <strong>予約人数を入力してください</strong>
    @enderror
    @error('reservationday')
        <strong>予約日時を入力してください</strong>
    @enderror
  
     <div>
         <strong>予約者名</strong>
         <p>{{$user_name}}  様</p>
         
     </div>
     <div>
         <strong>予約人数</strong>
         <input type="number" name="reservationnumber" placeholder="2" min="1" value="{{old('reservationnumber')}}">
     </div>
     <div>
         <strong>予約日時</strong>
         <input type="datetime-local" name="reservationday" value="{{old('reservationday')}}">
     </div>

     <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">

     <div>
         <button type="submit" class="btn btn-primary">予約確定</button>
     </div>
 
 </form>

 <a class="btn btn-outline-dark text-right" href="{{route('restaurants.show', $restaurant)}}">戻る</a>

</head>
</html>
@endsection