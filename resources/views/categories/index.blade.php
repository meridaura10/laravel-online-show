<div>
    <div class="fs-3 fw-bold">
        @lang('views/categories/show.listCategories')
    </div>
    <ul class="p-0 d-flex flex-wrap gap-2 ">
        @foreach($categories as $category)
            <li class="list-group-item categoryItem  p-1 bg-blue"><a href="{{route('categories.show', compact('category'))}}">{{ $category->translateOrDefault(app()->getLocale())->name }}</a></li>
        @endforeach
    </ul>
</div>
