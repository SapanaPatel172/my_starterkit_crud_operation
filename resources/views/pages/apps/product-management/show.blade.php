<x-default-layout>

    @section('title')
    Products
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('product-management.show', $product) }}

    @endsection

    <!--begin::Layout-->
    <div class=" flex-column flex-lg-row d-flex flex-center">
        <!--begin::Sidebar-->
        <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
            <!--begin::Card-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Summary-->
                    <!--begin::User Info-->
                    <div class="d-flex flex-center flex-column py-5">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            @if($product->product_image)
                            <img src="{{ asset('storage/' . $product->product_image) }}" alt="image" />
                            @else
                            <div class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', $product->name) }}">
                                {{ substr($product->name, 0, 1) }}
                            </div>
                            @endif
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $product->name }}</a>
                        <span>{{ $product->price }}</span>
                        <!--end::Name-->


                        <!--end::Details content-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->

            </div>
        </div>
    </div>
</x-default-layout>