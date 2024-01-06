@extends('layouts.app')

@section('content') 
<div class="d-flex justify-content-center">
  <a class="btn btn-outline-dark text-center" href="{{route('mypage')}}">マイページに戻る</a>
</div>


<h2 class="fs-4 d-flex justify-content-center" style="margin: 30px;">
  @if (session('message'))
    {{ session('message') }}
  @endif
  @foreach ($reservations as $reservation)
   {{ $reservation->restaurant->name }}
   {{ $reservation->reservationday }}
   {{ $reservation->reservationnumber }}
</h2>
<form action="{{route('reservations.destroy', $reservation)}}" method="post" onsubmit="return confirm('予約をキャンセルします。よろしいですか？');">
  @csrf
  @method('DELETE')
  <div class="d-flex justify-content-center">
   <button type="submit" class="btn btn-danger">キャンセルする</button>
  </div>
</form>

@endforeach

@endsection