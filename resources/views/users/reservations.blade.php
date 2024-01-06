@extends('layouts.app')

@section('content') 
@if (session('message'))
{{ session('message') }}
@endif
    @foreach ($reservations as $reservation)
{{ $reservation->restaurant->name }}
{{ $reservation->reservationday }}
{{ $reservation->reservationnumber }}

<form action="{{route('reservations.destroy', $reservation)}}" method="post" onsubmit="return confirm('予約をキャンセルします。よろしいですか？');">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">キャンセルする</button>
</form>

<a class="btn btn-outline-dark text-right" href="{{route('mypage')}}">マイページに戻る</a>

@endforeach

@endsection