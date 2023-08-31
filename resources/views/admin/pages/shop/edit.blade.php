@extends('admin.layout.main')

@section('content')
<form action="{{ route('shop.update',$shop->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="formGroupExampleInput">Name</label>
      <input type="text" name="name" class="form-control" id="formGroupExampleInput" value="{{$shop->name}}">
    </div>
    <div class="form-group mt-3">
        <label for="formGroupExampleInput">Email</label>
        <input type="email" name="email" class="form-control" id="formGroupExampleInput" value="{{$shop->email}}">
      </div>
      <div class="form-group mt-3">
        <label for="formGroupExampleInput">Address</label>
        <input type="text" name="address" class="form-control" id="formGroupExampleInput" value="{{$shop->address}}">
      </div>
      <div class="form-group mt-3">
        <label for="formGroupExampleInput">Website link</label>
        <input type="text" name="website" class="form-control" id="formGroupExampleInput" value="{{$shop->website}}">
      </div>
    <div class="form-group mt-3">
      <label for="formGroupExampleInput2">Text</label>
      <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$shop->description}}</textarea>
    </div>
    <div class="form-group mt-3">
        <label for="formGroupExampleInput2">Logo</label>
        <input type="file" name="logo" class="form-control-file" id="exampleFormControlFile1">
      </div>
  
</div>
<div class="modal-footer">

<button type="submit" class="btn btn-primary ">Save</button>
</div>
</form>
@endsection