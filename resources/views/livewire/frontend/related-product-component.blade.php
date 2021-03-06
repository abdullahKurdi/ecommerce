<div>
    <h2 class="h5 text-uppercase mb-4">Related products</h2>
    <div class="row">
        <!-- PRODUCT-->
        @forelse($relatedProducts as $related)
            <div class="col-lg-3 col-sm-6">
                <div class="product text-center skel-loader">
                    <div class="d-block mb-3 position-relative"><a class="d-block" href="{{ route('frontend.product',$related->slug) }}"><img class="img-fluid w-100" src="{{asset('assets/products/'.$related->firstMedia->file_name)}}" alt="{{$related->name}}"></a>
                        <div class="product-overlay">
                            <ul class="mb-0 list-inline">
                                <li class="list-inline-item m-0 p-0">
                                    <a wire:click.prevent="addToWishList('{{$related->id}}')" class="btn btn-sm btn-outline-dark" ><i class="far fa-heart"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item m-0 p-0">
                                    <a wire:click.prevent="addToCart('{{$related->id}}')" class="btn btn-sm btn-dark" >Add to cart
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <a  wire:click.prevent="$emit('showProductModalAction','{{$related->slug}}')" class="btn btn-sm btn-outline-dark" data-bs-target="#productView"  data-bs-toggle="modal"><i class="fas fa-expand"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <h6> <a class="reset-anchor" href="{{ route('frontend.product',$related->id) }}">{{$related->name}}</a></h6>
                    <p class="small text-muted">${{$related->price}}</p>
                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>
