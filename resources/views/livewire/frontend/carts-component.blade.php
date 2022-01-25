<div class="d-flex">
    <li class="nav-item">
        <a class="nav-link" href="{{route('frontend.cart')}}">
            <i class="fas fa-dolly-flatbed me-1 text-gray"></i>
            <small class="text-gray fw-normal">({{$countCart}})</small>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('frontend.wishlist')}}">
            <i class="far fa-heart me-1"></i>
            <small class="text-gray fw-normal"> ({{$countWishlist}})</small>
        </a>
    </li>
</div>
