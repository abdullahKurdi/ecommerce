@extends('layouts.app')
@section('content')
      <section class="py-5">
        <div class="container">
          <div class="row mb-5">
            <div class="col-lg-6">
              <!-- PRODUCT SLIDER-->
              <div class="row m-sm-0">
                <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0 px-xl-2">
                  <div class="swiper product-slider-thumbs">
                    <div class="swiper-wrapper">
                        @foreach($product->media as $media)
                          <div class="swiper-slide h-auto swiper-thumb-item mb-3">
                              <img class="w-100" src="{{asset('assets/products/'.$media->file_name)}}" alt="{{$product->name}}">
                          </div>
                        @endforeach
                    </div>
                  </div>
                </div>
                <div class="col-sm-10 order-1 order-sm-2">
                  <div class="swiper product-slider">
                    <div class="swiper-wrapper">
                        @foreach($product->media as $media)
                      <div class="swiper-slide h-auto">
                          <a class="glightbox product-view" href="{{asset('assets/products/'.$media->file_name)}}" data-gallery="gallery2" data-glightbox="{{$product->name}}">
                              <img class="img-fluid" src="{{asset('assets/products/'.$media->file_name)}}" alt="{{$product->name}}">
                          </a>
                      </div>
                        @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- PRODUCT detali-->
            <div class="col-lg-6">
              <ul class="list-inline mb-2 text-sm">
                  @if ($product->reviews_avg_rating != '')
                      @for ($i = 0; $i < 5; $i++)
                          <li class="list-inline-item m-0"><i class="{{ round($product->reviews_avg_rating) <= $i ? 'far' : 'fas' }} fa-star fa-sm text-warning"></i></li>
                      @endfor
                  @else
                      <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                      <li class="list-inline-item m-0 1"><i class="fas fa-star small text-warning"></i></li>
                      <li class="list-inline-item m-0 2"><i class="fas fa-star small text-warning"></i></li>
                      <li class="list-inline-item m-0 3"><i class="fas fa-star small text-warning"></i></li>
                      <li class="list-inline-item m-0 4"><i class="fas fa-star small text-warning"></i></li>
                  @endif
              </ul>
              <h1>{{$product->name}}</h1>
              <p class="text-muted lead">${{$product->price}}</p>
              <p class="text-sm mb-4">{{$product->description}}</p>

              <livewire:frontend.show-product-component :product="$product" />

              <br>
              <ul class="list-unstyled small d-inline-block">
                <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Category:</strong><a class="reset-anchor ms-2" href="#!">{{$product->category->name}}</a></li>
                <li class="px-3 py-2 mb-1 bg-white text-muted">
                    <strong class="text-uppercase text-dark">Tags:</strong>
                    @foreach($product->tags as $tag)
                    <a class="reset-anchor ms-2" href="{{$tag->id}}">{{$tag->name}}</a>
                    @endforeach
                </li>
              </ul>
            </div>
          </div>
          <!-- productS TABS-->
          <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
            <li class="nav-item"><a class="nav-link text-uppercase active" id="description-tab" data-bs-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a></li>
            <li class="nav-item"><a class="nav-link text-uppercase" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a></li>
          </ul>
          <div class="tab-content mb-5" id="myTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
              <div class="p-4 p-lg-5 bg-white">
                <h6 class="text-uppercase">Product description </h6>
                <p class="text-muted text-sm mb-0">{!!  $product->description !!}</p>
              </div>
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
              <div class="p-4 p-lg-5 bg-white">
                <div class="row">
                  <div class="col-lg-8">
                  @forelse($product->reviews as $review)
                    <div class="d-flex mb-3">
                      <div class="flex-shrink-0"><img class="rounded-circle" src="{{asset('assets/users/'.$review->user->user_image)}}" alt="" width="50"/></div>
                      <div class="ms-3 flex-shrink-1">
                        <h6 class="mb-0 text-uppercase">{{$review->name}}</h6>
                        <p class="small text-muted mb-0 text-uppercase">{{$review->created_at->format('d M, y')}}</p>
                        <ul class="list-inline mb-1 text-xs">
                            @if ($review->rating != '')
                                @for ($i = 0; $i < 5; $i++)
                                    <li class="list-inline-item m-0"><i class="{{ round($review->rating) <= $i ? 'far' : 'fas' }} fa-star fa-sm text-warning"></i></li>
                                @endfor
                            @else
                                <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                                <li class="list-inline-item m-0 1"><i class="fas fa-star small text-warning"></i></li>
                                <li class="list-inline-item m-0 2"><i class="fas fa-star small text-warning"></i></li>
                                <li class="list-inline-item m-0 3"><i class="fas fa-star small text-warning"></i></li>
                                <li class="list-inline-item m-0 4"><i class="fas fa-star small text-warning"></i></li>
                            @endif
                        </ul>
                          <p class="text-sm mb-0 text-muted"><strong>{{$review->title}}</strong></p>
                        <p class="text-sm mb-0 text-muted">{{$review->message}}</p>
                      </div>
                    </div>
                  @empty
                          <div class="d-flex mb-3">
                              <div class="flex-shrink-0">
                                  No Reviews
                              </div>
                          </div>
                  @endforelse
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- RELATED PRODUCTS-->
          <livewire:frontend.related-product-component :relatedProducts="$relatedProducts" />
        </div>
      </section>
@endsection
