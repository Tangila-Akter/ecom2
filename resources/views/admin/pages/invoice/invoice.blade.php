@extends('admin.layout.main')
@section('title', 'Invoice')
@section('content')
    <div class="card">
        <div class="col-xxl-9">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header border-bottom-dashed p-4">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <img src="assets/images/logo-dark.png" class="card-logo card-logo-dark" alt="logo dark"
                                        height="17">
                                    <img src="assets/images/logo-light.png" class="card-logo card-logo-light"
                                        alt="logo light" height="17">
                                    <div class="mt-sm-5 mt-4">
                                        <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                        <p class="text-muted mb-1" id="address-details">California, United States</p>
                                        <p class="text-muted mb-0" id="zip-code"><span>Zip-code:</span> 90201</p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 mt-sm-0 mt-3">
                                    <h6><span class="text-muted fw-normal">Legal Registration No:</span><span
                                            id="legal-register-no">987654</span></h6>
                                    <h6><span class="text-muted fw-normal">Email:</span><span
                                            id="email">velzon@themesbrand.com</span></h6>
                                    <h6><span class="text-muted fw-normal">Website:</span> <a
                                            href="https://themesbrand.com/" class="link-primary" target="_blank"
                                            id="website">www.themesbrand.com</a></h6>
                                    <h6 class="mb-0"><span class="text-muted fw-normal">Contact No: </span><span
                                            id="contact-no"> +(01) 234 6789</span></h6>
                                </div>
                            </div>
                        </div>
                        <!--end card-header-->
                    </div><!--end col-->
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Invoice No</p>
                                    <h5 class="fs-14 mb-0">#{{ $invoice->invoice_no ?? '' }}</h5>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                    <h5 class="fs-14 mb-0"><span
                                            id="invoice-date">{{ date('d-M, Y', strtotime($invoice->created_at)) }}</span>
                                    </h5>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Payment Status</p>
                                    <span class="badge bg-success-subtle text-success fs-11" id="payment-status">Paid</span>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Total Amount</p>
                                    <h5 class="fs-14 mb-0">$<span id="total-amount">755.96</span></h5>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div><!--end col-->
                    <div class="col-lg-12">
                        <div class="card-body p-4 border-top border-top-dashed">
                            <div class="row g-3">
                                <div class="col-6">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Billing Address</h6>
                                    <p class="fw-medium mb-2" id="billing-name">{{ $invoice->shop->name ?? '' }}</p>
                                    <p class="text-muted mb-1" id="billing-address-line-1">
                                        {{ $invoice->shop->address ?? '' }}
                                    </p>
                                    <p class="text-muted mb-1"><span>Phone: +</span><span id="billing-phone-no">(123)
                                            456-7890</span></p>
                                    <p class="text-muted mb-0"><span>Website: </span><span
                                            id="billing-tax-no">{{ $invoice->shop->website ?? '' }}</span>
                                    </p>
                                </div>
                                <!--end col-->
                                <div class="col-6">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Billing Address</h6>
                                    <p class="fw-medium mb-2" id="billing-name">{{ $invoice->shop->name ?? '' }}</p>
                                    <p class="text-muted mb-1" id="billing-address-line-1">
                                        {{ $invoice->shop->address ?? '' }}
                                    </p>
                                    <p class="text-muted mb-1"><span>Phone: +</span><span id="billing-phone-no">(123)
                                            456-7890</span></p>
                                    <p class="text-muted mb-0"><span>Website: </span><span
                                            id="billing-tax-no">{{ $invoice->shop->website ?? '' }}</span>
                                    </p>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div><!--end col-->
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr class="table-active">
                                            <th scope="col" style="width: 50px;">#</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody id="products-list">
                                        @foreach ($invoice->products as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td class="text-start">
                                                    <span class="fw-medium">{{ $item->product->name ?? '' }}</span>
                                                </td>
                                                <td>{{ $item->quantity ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table><!--end table-->
                            </div>
                            <div class="border-top border-top-dashed mt-2">
                                <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto"
                                    style="width:290px">
                                    <tbody>
                                        <tr>
                                            <td>Total Quantity</td>
                                            <td class="text-start">
                                                @php
                                                    $totalQuantity = 0;
                                                @endphp

                                                @foreach ($invoice->products as $item)
                                                    @php
                                                        $totalQuantity += $item->quantity;
                                                    @endphp
                                                @endforeach

                                                {{ $totalQuantity }}
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end table-->
                            </div>
                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                <a href="javascript:window.print()" class="btn btn-success"><i
                                        class="ri-printer-line align-bottom me-1"></i> Print</a>
                                <a href="javascript:void(0);" class="btn btn-primary"><i
                                        class="ri-download-2-line align-bottom me-1"></i> Download</a>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div><!--end col-->
                </div><!--end row-->
            </div>
            <!--end card-->
        </div>
    </div>
@endsection
