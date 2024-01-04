@extends('layouts.app')
 
 @section('content')
 <div class="container d-flex justify-content-center mt-3">
 <link rel="stylesheet" href="{{ asset('/css/tabelog.css') }}">
     <div class="w-50">
         <h1>マイページ</h1>
 
         <hr>
 
         <div class="container">
             <div class="d-flex justify-content-between">
                 <div class="row">
                     <div class="col-2 d-flex align-items-center">
                         <i class="fas fa-user fa-3x"></i>
                     </div>
                     <div class="col-9 d-flex align-items-center ms-2 mt-3">
                         <div class="d-flex flex-column">
                         <a class="btn btn-primary" label for="user-name" href="{{route('mypage.edit')}}">会員情報の編集</a>
                         </div>
                     </div>
                 </div>
                 <div class="d-flex align-items-center">
                         <i class="fas fa-chevron-right fa-2x"></i>
                     </a>
                 </div>
             </div>
         </div>
 
         <hr>
 
         <div class="container">
             <div class="d-flex justify-content-between">
                 <div class="row">
                     <div class="col-2 d-flex align-items-center">
                         <i class="fas fa-archive fa-3x"></i>
                     </div>
                     <div class="col-9 d-flex align-items-center ms-2 mt-3">
                         <div class="d-flex flex-column">
                         <a class="btn btn-primary" label for="user-name" href="{{route('mypage.reservations')}}">予約確認</a>
                         </div>
                     </div>
                 </div>
                 <div class="d-flex align-items-center">
                     <a href="{{('mypage')}}">
                         <i class="fas fa-chevron-right fa-2x"></i>
                     </a>
                 </div>
             </div>
         </div>
 
         <hr>
 
         <div class="container">
             <div class="d-flex justify-content-between">
                 <div class="row">
                     <div class="col-2 d-flex align-items-center">
                         <i class="fas fa-sign-out-alt fa-3x"></i>
                     </div>
                     <div class="col-9 d-flex align-items-center ms-2 mt-3">
                         <div class="d-flex flex-column">
                         <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                         </div>
                     </div>
                 </div>
                 <div class="d-flex align-items-center">
                         <i class="fas fa-chevron-right fa-2x"></i>
                     </a>
 
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         @csrf
                     </form>
                 </div>
             </div>
         </div>
 
         <hr>
     </div>
 </div>
 @endsection
