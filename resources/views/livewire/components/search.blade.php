<div class="d-flex justify-content-center pt-10">
    <div class="position-relative" style="width: 560px;">
        <input wire:model="search" class="form-control border py-2 px-4 mb-2" placeholder="Search..." type="text" />
        <div class="position-absolute z-100 top-100 start-0 end-0" style="z-index: 100">
            @if ($dropdown)
                <ul class="shadow list-group overflow-auto bg-white">
                    @forelse ($products as $product)
                        <li class="py-2 px-4 list-group-item">
                            <a href="{{ route('products.show', compact('product')) }}" class="d-flex align-items-center text-decoration-none">
                                <img src="{{ asset('storage/images/' . $product->bannerImage->path) }}" alt="{{ $product->translateOrDefault(app()->getLocale())->name }}" class="me-2 rounded" style="width: 60px; height: 60px;">
                                <div>{{ $product->translateOrDefault(app()->getLocale())->name }}</div>
                            </a>
                        </li>
                    @empty
                        <li class="py-2 px-4">No results found</li>
                    @endforelse
                </ul>
            @endif
        </div>
    </div>
</div>






{{-- <div>
    <input wire:model='search' type="text">
    <ul class="text-white">
        @foreach ($results as $result)
            <li>
                {{ $result->translateOrDefault(app()->getLocale())->name }}
                - {{ $result->translateOrDefault(app()->getLocale())->description }}
                <div>
                    @foreach ($result->categories as $category)
                        {{$category->translateOrDefault(app()->getLocale())->name}}
                    @endforeach
                </div>
            </li>

        @endforeach
    </ul>

</div> --}}
