@extends('admin.layout.main')

@section('content')

<form action="{{ route('product.update',$product->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="formGroupExampleInput">Name</label>
      <input type="text" name="name" class="form-control" id="formGroupExampleInput" value="{{$product->name}}">
    </div>
    
    {{-- <div class="form-group">
      
      <label for="exampleFormControlSelect1">Select Shop</label>
      <select class="form-control" id="exampleFormControlSelect1" name="shop_id">
          @foreach ($shop as $shop)
        <option value="{{$shop->id}}">{{$shop->name}}</option>
        @endforeach
      </select>
      
    </div> 
    --}}
    
      <div class="form-group mt-3">
        <label for="formGroupExampleInput">Website link</label>
        <input type="text" name="website" class="form-control" id="formGroupExampleInput" value="{{$product->website}}">
      </div>
    <div class="form-group mt-3">
      <label for="formGroupExampleInput2">Text</label>
      <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$product->description}}</textarea>
    </div>
    <div class="form-group mt-3">
        <label for="formGroupExampleInput2">Logo</label>
        <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
      </div>
</div>
<div class="modal-footer">

<button type="submit" class="btn btn-primary ">Save</button>
</div>
</form>
@endsection