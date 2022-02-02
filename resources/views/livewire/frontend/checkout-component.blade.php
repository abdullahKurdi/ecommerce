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
                            class="custom-control-input text-dark p-0 shadow-0"
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
        @if ($customer_address_id != 0 && $shipping_company_id != 0)
        <h2 class="h5 text-uppercase mt-4 mb-4">Payment Methods</h2>
            <div class="row">
                @forelse($payment_methods as $payment_method)
                    <div class="col-6 form-group">
                        <div class="custom-control custom-radio">
                            <input
                                type="radio"
                                id="payment-method-{{ $payment_method->id }}"
                                class="custom-control-input"
                                wire:model="payment_method_id"
                                wire:click="updatePaymentMethod()"
                                {{ intval($payment_method_id) == $payment_method->id ? 'checked' : '' }}
                                value="{{ $payment_method->id }}">
                            <label for="payment-method-{{ $payment_method->id }}" class="custom-control-label text-small">
                                <b>{{ $payment_method->name }}</b>
                            </label>
                        </div>
                    </div>
                @empty
                    <p>No payment way found</p>
                @endforelse
            </div>
        @endif
        @if ($customer_address_id != 0 && $shipping_company_id != 0 && $payment_method_id != 0)
            @if (\Illuminate\Support\Str::lower($payment_method_code) == 'ppex')
                <form action="{{ route('checkout.payment') }}" method="post">
                    @csrf
                    <input type="hidden" name="customer_address_id" value="{{ old('customer_address_id', $customer_address_id) }}" class="form-control">
                    <input type="hidden" name="shipping_company_id" value="{{ old('shipping_company_id', $shipping_company_id) }}" class="form-control">
                    <input type="hidden" name="payment_method_id" value="{{ old('payment_method_id', $payment_method_id) }}" class="form-control">
                    <button type="submit" name="submit" class="btn btn-dark btn-sm btn-block mt-2">
                        Continue to checkout with PayPal
                    </button>
                </form>
            @endif
        @endif
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
