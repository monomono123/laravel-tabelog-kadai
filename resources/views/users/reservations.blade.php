@extends('layouts.app')

@section('content') 

<a class="btn btn-outline-dark text-right" href="{{route('mypage')}}">マイページに戻る</a>
<br>
<br>
<br>

<p class="fs-4">
@if (session('message'))
{{ session('message') }}
@endif
@foreach ($reservations as $reservation)
{{ $reservation->restaurant->name }}
{{ $reservation->reservationday }}
{{ $reservation->reservationnumber }}
</p>
<form action="{{route('reservations.destroy', $reservation)}}" method="post" onsubmit="return confirm('予約をキャンセルします。よろしいですか？');">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">キャンセルする</button>
</form>

@endforeach

@endsection