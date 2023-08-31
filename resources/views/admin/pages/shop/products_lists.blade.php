@extends('admin.layout.main')
@section('title', 'Product Lists')
@section('content')
    <h2>Product Lists</h2>
    {{-- table starts --}}
    <div class="card">
        <div class="card-body">
            @include('admin.layout.notifications')
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Website link</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->email }}</td>
                                <td>{{ $product->address }}</td>
                                <td>{{ $product->website }}</td>
                                <td>{{ $product->description }}</td>
                                <td><img height="100" width="100" src="{{ asset($product->image) }}"></td>
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('product.addToCart') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <input type="submit" class="btn btn-success" value="Add to cart">
                                        </form>

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
