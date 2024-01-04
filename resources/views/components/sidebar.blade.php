<div class="container">
    @foreach ($category_names as $category_name)
        <h2>{{ $category_name }}</h2>
            @if ($category->category_name === $category_name)
              <label class="restaurant-sidebar-category-label"><a href="{{ route('restaurants.index', ['category' => $category->id]) }}">{{ $category->name }}</a></label>
            @endif
        @endforeach
    @endforeach
</div>
