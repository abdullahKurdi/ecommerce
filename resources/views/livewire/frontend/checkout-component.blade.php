<div class="row">
    <div class="col-lg-8">
            <div class="row">
                <h2 class="h5 text-uppercase mb-4">Shipping Addresses</h2>
                @forelse($addresses as $address)
                    <div class="col-6 form-group">
                        <div class="custom-control custom-radio">
                            <input
                                type="radio"
                                id="address-{{$address->id}}"
                                class="custom-control-input"
                                wire:model="customer_address_id"
                                wire:click="updateShippingCompanies()"
                                {{ intval($customer_address_id) == $address->id ? 'checked' : '' }}
                                value="{{$address->id}}">
                            <label for="address-{{$address->id}}" class="custom-control-label text-small">
                                <b>{{$address->address_title}}</b>
                            </label>
                            <small>
                                <br>
                                {{ $address->address }}
                                {{ $address->country->name }} - {{ $address->state->name }} - {{ $address->city->name }}
                            </small>

                        </div>
                    </div>
                @empty
                    <p>No Addresses Found!</p>
                    <a href="">Add an address</a>
                @endforelse
            </div>
        @if ($customer_address_id != 0)
            <h2 class="h5 text-uppercase mt-4 mb-4">Sipping way</h2>
        <div class="row">
            @forelse($shipping_companies as $shipping_company)
                <div class="col-6 form-group">
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            id="shipping-company-{{ $shipping_company->id }}"
                            class="custom-control-input"
                            wire:model="shipping_company_id"
                            wire:click="updateShippingCost()"
                            {{ intval($shipping_company_id) == $shipping_company->id ? 'checked' : '' }}
                            value="{{ $shipping_company->id }}">
                        <label for="shipping-company-{{ $shipping_company->id }}" class="custom-control-label text-small">
                            <b>{{ $shipping_company->name }}</b>
                            <small>
                                {{ $address->description }} - (${{ $shipping_company->cost }})
                            </small>
                        </label>
                    </div>
                </div>
            @empty
                <p>No shipping companies found</p>
            @endforelse
        </div>
        @endif
{{--        <form action="#">--}}
{{--            <div class="row gy-3">--}}
{{--                <div class="col-lg-6">--}}
{{--                    <label class="form-label text-sm text-uppercase" for="firstName">First name </label>--}}
{{--                    <input class="form-control form-control-lg" type="text" id="firstName" placeholder="Enter your first name">--}}
{{--                </div>--}}
{{--                <div class="col-lg-6">--}}
{{--                    <label class="form-label text-sm text-uppercase" for="lastName">Last name </label>--}}
{{--                    <input class="form-control form-control-lg" type="text" id="lastName" placeholder="Enter your last name">--}}
{{--                </div>--}}
{{--                <div class="col-lg-6">--}}
{{--                    <label class="form-label text-sm text-uppercase" for="email">Email address </label>--}}
{{--                    <input class="form-control form-control-lg" type="email" id="email" placeholder="e.g. Jason@example.com">--}}
{{--                </div>--}}
{{--                <div class="col-lg-6">--}}
{{--                    <label class="form-label text-sm text-uppercase" for="phone">Phone number </label>--}}
{{--                    <input class="form-control form-control-lg" type="tel" id="phone" placeholder="e.g. +02 245354745">--}}
{{--                </div>--}}
{{--                <div class="col-lg-6">--}}
{{--                    <label class="form-label text-sm text-uppercase" for="company">Company name (optional) </label>--}}
{{--                    <input class="form-control form-control-lg" type="text" id="company" placeholder="Your company name">--}}
{{--                </div>--}}
{{--                <div class="col-lg-6 form-group">--}}
{{--                    <label class="form-label text-sm text-uppercase" for="country">Country</label>--}}
{{--                    <select class="country form-control form-control-lg" id="country" data-customclass="form-control form-control-lg rounded-0">--}}
{{--                        <option value="">Choose your country</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--                <div class="col-lg-12">--}}
{{--                    <label class="form-label text-sm text-uppercase" for="address">Address line 1 </label>--}}
{{--                    <input class="form-control form-control-lg" type="text" id="address" placeholder="House number and street name">--}}
{{--                </div>--}}
{{--                <div class="col-lg-12">--}}
{{--                    <label class="form-label text-sm text-uppercase" for="addressalt">Address line 2 </label>--}}
{{--                    <input class="form-control form-control-lg" type="text" id="addressalt" placeholder="Apartment, Suite, Unit, etc (optional)">--}}
{{--                </div>--}}
{{--                <div class="col-lg-6">--}}
{{--                    <label class="form-label text-sm text-uppercase" for="city">Town/City </label>--}}
{{--                    <input class="form-control form-control-lg" type="text" id="city">--}}
{{--                </div>--}}
{{--                <div class="col-lg-6">--}}
{{--                    <label class="form-label text-sm text-uppercase" for="state">State/County </label>--}}
{{--                    <input class="form-control form-control-lg" type="text" id="state">--}}
{{--                </div>--}}
{{--                <div class="col-lg-6">--}}
{{--                    <button class="btn btn-link text-dark p-0 shadow-0" type="button" data-bs-toggle="collapse" data-bs-target="#alternateAddress">--}}
{{--                        <div class="form-check">--}}
{{--                            <input class="form-check-input" id="alternateAddressCheckbox" type="checkbox">--}}
{{--                            <label class="form-check-label" for="alternateAddressCheckbox">Alternate billing address</label>--}}
{{--                        </div>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="collapse" id="alternateAddress">--}}
{{--                    <div class="row gy-3">--}}
{{--                        <div class="col-12 mt-4">--}}
{{--                            <h2 class="h4 text-uppercase mb-4">Alternative billing details</h2>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <label class="form-label text-sm text-uppercase" for="firstName2">First name </label>--}}
{{--                            <input class="form-control form-control-lg" type="text" id="firstName2" placeholder="Enter your first name">--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <label class="form-label text-sm text-uppercase" for="lastName2">Last name </label>--}}
{{--                            <input class="form-control form-control-lg" type="text" id="lastName2" placeholder="Enter your last name">--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <label class="form-label text-sm text-uppercase" for="email2">Email address </label>--}}
{{--                            <input class="form-control form-control-lg" type="email" id="email2" placeholder="e.g. Jason@example.com">--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <label class="form-label text-sm text-uppercase" for="phone2">Phone number </label>--}}
{{--                            <input class="form-control form-control-lg" type="tel" id="phone2" placeholder="e.g. +02 245354745">--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <label class="form-label text-sm text-uppercase" for="company2">Company name (optional) </label>--}}
{{--                            <input class="form-control form-control-lg" type="text" id="company2" placeholder="Your company name">--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6 form-group">--}}
{{--                            <label class="form-label text-sm text-uppercase" for="countryAlt">Country</label>--}}
{{--                            <select class="country" id="countryAlt" data-customclass="form-control form-control-lg rounded-0">--}}
{{--                                <option value>Choose your country</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-12">--}}
{{--                            <label class="form-label text-sm text-uppercase" for="address2">Address line 1 </label>--}}
{{--                            <input class="form-control form-control-lg" type="text" id="address2" placeholder="House number and street name">--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-12">--}}
{{--                            <label class="form-label text-sm text-uppercase" for="addressalt2">Address line 2 </label>--}}
{{--                            <input class="form-control form-control-lg" type="text" id="addressalt2" placeholder="Apartment, Suite, Unit, etc (optional)">--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <label class="form-label text-sm text-uppercase" for="city2">Town/City </label>--}}
{{--                            <input class="form-control form-control-lg" type="text" id="city2">--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <label class="form-label text-sm text-uppercase" for="state2">State/County </label>--}}
{{--                            <input class="form-control form-control-lg" type="text" id="state2">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-12 form-group">--}}
{{--                    <button class="btn btn-dark" type="submit">Place order</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
    </div>

    <!-- ORDER SUMMARY-->
    <div class="col-lg-4">
        <div class="card border-0 rounded-0 p-lg-4 bg-light">
            <div class="card-body">
                <h5 class="text-uppercase mb-4">Your order</h5>
                <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center justify-content-between">
                        <strong class="small fw-bold">Subtotal</strong>
                        <span class="text-muted small">{{$cart_subtotal}}</span>
                    </li>
                    @if(session()->has('coupon'))
                        <li class="border-bottom my-2"></li>
                        <li class="d-flex align-items-center justify-content-between">
                            <strong class="small fw-bold">Discount (<small>code :{{session()->get('coupon')['code']}}</small>)</strong>
                            <span class="text-muted small">- ${{$cart_discount}}</span>
                        </li>

                    @endif
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between">
                        <strong class="small fw-bold">Tax</strong>
                        <span class="text-muted small">{{$cart_tax}}</span>
                    </li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between">
                        <strong class="text-uppercase small fw-bold">Total</strong>
                        <span>{{$cart_total}}</span>
                    </li>
                    <li class="my-4"></li>
                    <li>

                    <form wire:submit.prevent="applyDiscount()">
                        <div class="input-group mb-0">
                        @if(!session()->has('coupon'))
                        <input class="form-control my-2" wire:model="coupon_code" type="text" placeholder="Enter your coupon">
                        @endif
                        @if(session()->has('coupon'))
                        <button type="button" wire:click.prevent="removeCoupon()"  class="btn btn-danger btn-sm w-100"> <i class="fas fa-trash me-2"></i>Remove coupon</button>
                        @else
                        <button type="submit" class="btn btn-dark btn-sm w-100" > <i class="fas fa-gift me-2"></i>Apply coupon</button>
                        @endif
                        </div>
                    </form>


                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
