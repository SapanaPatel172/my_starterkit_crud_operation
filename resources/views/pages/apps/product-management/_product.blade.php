<!--begin:: Avatar -->
<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
    <a href="{{ route('product-management.show', $product) }}">

        @if($product->product_image)
        <div class="symbol-label">
        <img src="{{ asset('storage/' . $product->product_image) }}" class="w-100"/>
        </div>
        @else
        <div class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', $product->product_name) }}">
            {{ substr($product->product_name, 0, 1) }}
        </div>
        @endif
    </a>
</div>
<!--end::Avatar-->
<!--begin::product details-->
<div class="d-flex flex-column">
    <a href="{{ route('product-management.show', $product) }}" class="text-gray-800 text-hover-primary mb-1">
        {{ $product->product_name }}
    </a>
    <span>{{ $product->price }}</span>
</div>
<!--begin::product details-->