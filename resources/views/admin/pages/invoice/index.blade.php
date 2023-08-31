@extends('admin.layout.main')
@section('title', 'Products')
@section('content')
    <h2>Product</h2>
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#myModal">Create
                product</button>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Shop name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $invoice->invoice_no }}</td>
                                <td>{{ $invoice->shop_id }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn-sm btn btn-warning"
                                            href="{{ route('invoice.create', $invoice->id) }}">Generate Invoice</a>
                                        <a class="btn-sm btn btn-danger" href=""><i
                                                class="bx bx-bx bxs-trash"></i></a>
                                    </div>

                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
                <!-- end table -->

            </div>
        </div>
    </div>
    <!-- end table responsive -->
    {{-- table ends --}}
@endsection
