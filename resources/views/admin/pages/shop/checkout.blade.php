@extends('admin.layout.main')
@section('title', 'Product Lists')
@section('content')
    <h2>Create invoice</h2>
    {{-- table starts --}}
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-xl-12">
                    <div class="row align-items-center gy-3 mb-3">
                        <div class="col-sm">
                            <div>
                                <h5 class="fs-14 mb-0">Your Cart @if (session('cart'))
                                        {{ count(session('cart')) }}
                                    @else
                                        0
                                    @endif has items</h5>
                            </div>
                        </div>
                    </div>

                    {{-- get products from cart session --}}
                    @if (session('cart'))
                        @foreach (session('cart') as $id => $details)
                            {{-- @php
                                
                                dd($details);
                            @endphp --}}
                            <div class="card product" data-product-id="{{ $id }}">
                                <div class="card-body">
                                    <div class="row gy-3">
                                        <div class="col-sm-auto">
                                            <div class="bg-light rounded p-1">
                                                <img src="{{ asset($details['image']) }}" width="120" height="120"
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <h5 class="fs-14 text-truncate"><a href="ecommerce-product-detail.html"
                                                    class="text-body">{{ $details['name'] }}</a></h5>
                                            <div class="input-step">
                                                <button type="button" class="minus remove_quantity"
                                                    data-product-id="{{ $id }}">–</button>
                                                <input type="number" class="product-quantity"
                                                    value="{{ $details['quantity'] ?? 1 }}" min="0" max="100">
                                                <button type="button" class="plus add_quantity"
                                                    data-product-id="{{ $id }}">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- card body -->
                                <div class="card-footer">
                                    <div class="row align-items-center gy-3">
                                        <div class="col-sm">
                                            <div class="d-flex flex-wrap my-n1">
                                                <div>
                                                    <form action="{{ route('product.remove') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $id }}">
                                                        <button type="submit" class="btn d-block text-body p-1 px-2"> <i
                                                                class="ri-delete-bin-fill text-muted align-bottom me-1"></i>
                                                            Remove</button>
                                                    </form>
                                                </div>
                                                <div>
                                                    <form action="{{ route('product.updateCart') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $id }}">
                                                        <input class="quantity" type="hidden" name="quantity"
                                                            value="{{ $details['quantity'] }}">
                                                        <button type="submit"
                                                            class="btn d-block text-body p-1 px-2 update_quantity"
                                                            data-id="{{ $id }}">
                                                            Update
                                                        </button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-sm-auto">
                                            <div class="d-flex align-items-center gap-2 text-muted">
                                                <div>Total :</div>
                                                <h5 class="fs-14 mb-0">$<span class="product-line-price">119.99</span></h5>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                                <!-- end card footer -->
                            </div>
                        @endforeach
                    @endif




                    <div class="text-end mb-4">
                        <a href="{{ route('product.createInvoice') }}" class="btn btn-success btn-label right ms-auto"><i
                                class="ri-arrow-right-line label-icon align-bottom fs-16 ms-2"></i> Create invoice</a>
                    </div>
                </div>
                <!-- end col -->

                {{-- <div class="col-xl-4">
                    <div class="sticky-side-div">
                        <div class="card">
                            <div class="card-header border-bottom-dashed">
                                <h5 class="card-title mb-0">Order Summary</h5>
                            </div>
                            <div class="card-header bg-light-subtle border-bottom-dashed">
                                <div class="text-center">
                                    <h6 class="mb-2">Have a <span class="fw-semibold">promo</span> code ?</h6>
                                </div>
                                <div class="hstack gap-3 px-3 mx-n3">
                                    <input class="form-control me-auto" type="text" placeholder="Enter coupon code"
                                        aria-label="Add Promo Code here...">
                                    <button type="button" class="btn btn-success w-xs">Apply</button>
                                </div>
                            </div>
                            <div class="card-body pt-2">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <td>Sub Total :</td>
                                                <td class="text-end" id="cart-subtotal">$239.97</td>
                                            </tr>
                                            <tr>
                                                <td>Discount <span class="text-muted">(VELZON15)</span> : </td>
                                                <td class="text-end" id="cart-discount">-$36.00</td>
                                            </tr>
                                            <tr>
                                                <td>Shipping Charge :</td>
                                                <td class="text-end" id="cart-shipping">$65.00</td>
                                            </tr>
                                            <tr>
                                                <td>Estimated Tax (12.5%) : </td>
                                                <td class="text-end" id="cart-tax">$30.00</td>
                                            </tr>
                                            <tr class="table-active">
                                                <th>Total (USD) :</th>
                                                <td class="text-end">
                                                    <span class="fw-semibold" id="cart-total">$298.97</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                            </div>
                        </div>

                        <div class="alert border-dashed alert-danger" role="alert">
                            <div class="d-flex align-items-center">
                                <lord-icon src="https://cdn.lordicon.com/nkmsrxys.json" trigger="loop"
                                    colors="primary:#121331,secondary:#f06548" style="width:80px;height:80px"></lord-icon>
                                <div class="ms-2">
                                    <h5 class="fs-14 text-danger fw-semibold"> Buying for a loved one?</h5>
                                    <p class="text-body mb-1">Gift wrap and personalized message on card, <br>Only for
                                        <span class="fw-semibold">$9.99</span> USD
                                    </p>
                                    <button type="button" class="btn ps-0 btn-sm btn-link text-danger text-uppercase">Add
                                        Gift Wrap</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end stickey -->

                </div> --}}
            </div>
        </div>
    </div>
    <!-- end table responsive -->
    {{-- table ends --}}
@endsection


@section('custom_scripts')
    <script src="{{ asset('backend/assets/js/pages/form-input-spin.init.js') }}"></script>

    {{-- jquery cdn --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- custom js --}}

    <script>
        $(document).ready(function() {
            $(document).on('click', '.add_quantity', function() {
                var row = $(this).closest('.product');
                var quantityInput = row.find('.product-quantity');
                var currentQuantity = parseInt(quantityInput.val());
                quantityInput.val(currentQuantity);
                updateCart(row);
            });

            $(document).on('click', '.remove_quantity', function(e) {
                var row = $(this).closest('.product');
                var quantityInput = row.find('.product-quantity');
                var currentQuantity = parseInt(quantityInput.val());
                if (currentQuantity > 1) {
                    quantityInput.val(currentQuantity);
                    updateCart(row);
                }
            });

            function updateCart(row) {
                var quantityInput = row.find('.product-quantity');
                var newQuantity = parseInt(quantityInput.val());
                var form = row.find('form');
                form.find('input[name="quantity"]').val(newQuantity);
            }
        });
    </script>
@endsection
