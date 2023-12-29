<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store($restaurant_id)
    {
        Auth::user()->favorite_restautants()->attach($restaurant_id);

        return back();
    }

    public function destroy($restaurant_id)
    {
        Auth::user()->favorite_restautants()->detach($restaurant_id);

        return back();
    }
}
