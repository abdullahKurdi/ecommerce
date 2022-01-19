{{--<div>--}}
{{--    <section class="py-5">--}}
{{--        <header>--}}
{{--            <p class="small text-muted small text-uppercase mb-1">Made the hard way</p>--}}
{{--            <h2 class="h5 text-uppercase mb-4">Top trending products</h2>--}}
{{--        </header>--}}
{{--        <div class="row">--}}
{{--            <!-- PRODUCT-->--}}
{{--            @forelse($featuredProducts as $featuredProduct)--}}
{{--                <div class="col-xl-3 col-lg-4 col-sm-6">--}}
{{--                    <div class="product text-center">--}}
{{--                        <div class="position-relative mb-3">--}}
{{--                            <div class="badge text-white bg-"></div>--}}
{{--                            <a class="d-block" href="{{route('frontend.product',$featuredProduct->slug)}}">--}}
{{--                                <img class="img-fluid w-100" src="{{ asset('assets/products/' . $featuredProduct->firstMedia->file_name) }}" alt="..."></a>--}}
{{--                            <div class="product-overlay">--}}
{{--                                <ul class="mb-0 list-inline">--}}
{{--                                    <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#!"><i class="far fa-heart"></i></a></li>--}}
{{--                                    <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="cart.blade.php">Add to cart</a></li>--}}
{{--                                    <li class="list-inline-item me-0">--}}
{{--                                        <a class="btn btn-sm btn-outline-dark"  livwire:click="$emit('showProductModalAction', '{{ $featuredProduct->slug }}')" data-target=#productView" data-bs-toggle="modal">--}}
{{--                                            <i class="fas fa-expand"></i>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <h6> <a class="reset-anchor" href="product.blade.php">Kui Ye Chen’s AirPods</a></h6>--}}
{{--                        <p class="small text-muted">$250</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @empty--}}
{{--            @endforelse--}}
{{--        </div>--}}

{{--    </section>--}}
{{--</div>--}}
{{--<livewire:frontend.product-modal-shared/>--}}
<div>
    <section class="py-5">
        <header>
            <p class="small text-muted small text-uppercase mb-1">Made the hard way</p>
            <h2 class="h5 text-uppercase mb-4">Top trending products</h2>
        </header>
        <div class="row">
            <!-- PRODUCT-->
            @forelse($featuredProducts as $featuredProduct)
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="product text-center">
                    <div class="position-relative mb-3">
                        <div class="badge text-white bg-"></div>
                            <a class="d-block" href="{{route('frontend.product',$featuredProduct->slug)}}">
                                <img class="img-fluid w-100" src="{{ asset('assets/products/' . $featuredProduct->firstMedia->file_name) }}" alt="{{$featuredProduct->name}}">
                            </a>
                        <div class="product-overlay">
                            <ul class="mb-0 list-inline">
                                <li class="list-inline-item m-0 p-0">
                                    <a class="btn btn-sm btn-outline-dark" href="#!">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item m-0 p-0">
                                    <a class="btn btn-sm btn-dark" href="cart.html">
                                        Add to cart
                                    </a>
                                </li>
                                <li class="list-inline-item me-0">
                                    <a class="btn btn-sm btn-outline-dark" wire:click.prevent="$emit('showProductModalAction','{{$featuredProduct->slug}}')" data-bs-target="#productView" data-bs-toggle="modal">
                                        <i class="fas fa-expand"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <h6> <a class="reset-anchor" href="detail.html">{{$featuredProduct->name}}</a></h6>
                    <p class="small text-muted">{{$featuredProduct->price}}</p>
                </div>
            </div>
            @empty
            @endforelse
        </div>
{{--        <!--  frontend template Modal in pages  -->--}}
{{--        @include('partial.frontend.modal')--}}
        <livewire:frontend.product-modal-shared/>
    </section>
</div>
