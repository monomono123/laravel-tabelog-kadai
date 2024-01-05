<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\Category;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $keyword = $request->keyword;

        if ($request->category !== null) {
            $restaurants = Restaurant::where('category_id', $request->category)->paginate(10);
            $total_count = Restaurant::where('category_id', $request->category)->count();
            $category = Category::find($request->category);

        } elseif ($keyword !== null) {
            $restaurants = Restaurant::where('name', 'like', "%{$keyword}%")->orWhere('address', 'like', "%{$keyword}%")->paginate(10);
            $total_count = $restaurants->total();
            $category = null;
        
        } else {
            $restaurants = Restaurant::paginate(10);
            $total_count = "";
            $category = null;
        }


        $categories = Category::all();

        return view('restaurants.index', compact('restaurants','category', 'categories','total_count', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        $reviews = $restaurant->reviews()->get();

        return view('restaurants.show', compact('restaurant', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
