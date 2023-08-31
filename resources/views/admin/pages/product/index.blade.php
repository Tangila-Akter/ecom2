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
                            <th scope="col">Website URL</th>
                            <th scope="col">Text</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->website }}</td>
                                <td>{{ $product->description }}</td>
                                <td><img height="100" width="100" src="{{ asset($product->image) }}"></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn-sm btn btn-warning"
                                            href="{{ route('product.edit', $product->id) }}"><i
                                                class="bx bx-bx bxs-pencil"></i></a>
                                        <a class="btn-sm btn btn-danger"
                                            href="{{ route('product.delete', $product->id) }}"><i
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
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Add product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('product_create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="formGroupExampleInput">Product Name</label>
                            <input type="text" name="name" class="form-control" id="formGroupExampleInput"
                                placeholder="Enter shop name">
                        </div>
                        <div class="form-group mt-3">
                            <label for="exampleFormControlSelect1">Select Shop</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="shop_id">
                                @foreach ($shop as $shop)
                                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="formGroupExampleInput">Website link</label>
                            <input type="text" name="website" class="form-control" id="formGroupExampleInput"
                                placeholder="Enter sub title">
                        </div>
                        <div class="form-group mt-3">
                            <label for="formGroupExampleInput2">Description</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="formGroupExampleInput2">Product Image</label>
                            <input type="file" name="image" class="form-control" id="exampleFormControlFile1">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ">Save</button>
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
