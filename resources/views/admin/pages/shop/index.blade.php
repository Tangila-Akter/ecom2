@extends('admin.layout.main')
@section('title', 'All Shops')
@section('content')
    <h2>Shop</h2>
    {{-- table starts --}}
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#myModal">Create
                shop</button>
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
                        @foreach ($shop as $shop)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $shop->name }}</td>
                                <td>{{ $shop->email }}</td>
                                <td>{{ $shop->address }}</td>
                                <td>{{ $shop->website }}</td>
                                <td>{{ $shop->description }}</td>
                                <td><img height="100" width="100" src="{{ asset($shop->logo) }}"></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-success" href="{{ route('shop.show', $shop->id) }}"><i
                                                class="bx bx-bx bx bx-show"></i></a>
                                        <a class="btn btn-sm btn-warning" href="{{ route('shop.edit', $shop->id) }}"><i
                                                class="bx bx-bx bxs-pencil"></i></a>
                                        <a class="btn btn-sm btn-danger" href="{{ route('shop.delete', $shop->id) }}"><i
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


    <!-- Default Modals -->
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Create Shop</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('shop_create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="formGroupExampleInput">Name</label>
                            <input type="text" name="name" class="form-control" id="formGroupExampleInput"
                                placeholder="Enter shop name">
                        </div>
                        <div class="form-group mt-3">
                            <label for="formGroupExampleInput">Email</label>
                            <input type="email" name="email" class="form-control" id="formGroupExampleInput"
                                placeholder="Enter email address">
                        </div>
                        <div class="form-group mt-3">
                            <label for="formGroupExampleInput">Address</label>
                            <input type="text" name="address" class="form-control" id="formGroupExampleInput"
                                placeholder="Enter address">
                        </div>
                        <div class="form-group mt-3">
                            <label for="formGroupExampleInput">Website link</label>
                            <input type="text" name="website" class="form-control" id="formGroupExampleInput"
                                placeholder="Enter sub title">
                        </div>
                        <div class="form-group mt-3">
                            <label for="formGroupExampleInput2">Text</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="formGroupExampleInput2">Logo</label>
                            <input type="file" name="logo" class="form-control" id="exampleFormControlFile1">
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
